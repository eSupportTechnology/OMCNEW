<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Sale;
use App\Models\SpecialOffers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{

    
   // Show the form to create sales
    public function createSales()
    {

        $activeSales = Sale::where('status', 'active')->pluck('product_id')->toArray();
        $specialOffers = SpecialOffers::where('status', 'active')->pluck('product_id')->toArray();
        $excludedProductIds = array_merge($activeSales, $specialOffers);
        $products = Products::select('product_id', 'product_name', 'normal_price') 
                            ->whereNotIn('product_id', $excludedProductIds)
                            ->get();

        return view('admin_dashboard.add_sales', compact('products'));
    }


 

    public function showSales()
    {
        $this->updateExpiredSales();
        $sales = Sale::with(['product.images'])->get(); 
        return view('admin_dashboard.flash_sales', compact('sales'));
    }
    

    protected function updateExpiredSales()
    {
        $now = now();

        Sale::where('end_date', '<=', $now)
            ->update(['status' => 'inactive']);
    }
    


    public function storeSale(Request $request)
    {
    
            $data = $request->validate([
                'end_date' => 'required|date',
                'products' => 'required|array',
                'products.*.product_id' => 'required|exists:products,product_id',
                'products.*.normal_price' => 'required|numeric',
                'products.*.sale_rate' => 'required|numeric|min:0|max:100',
                'products.*.sale_price' => 'required|numeric',
            ]);
    
            // Create sale for each product
            foreach ($data['products'] as $product) {
                Sale::create([
                    'product_id' => $product['product_id'],
                    'normal_price' => $product['normal_price'],
                    'sale_rate' => $product['sale_rate'],
                    'sale_price' => $product['sale_price'],
                    'end_date' => $data['end_date'],
                    'status' => 'active',
                ]);
            }
    
            return redirect()->route('flash_sales')->with('status', 'Flash sales added successfully!');
    }
    
    




    public function edit($id)
    {
        $sale = Sale::with('product')->findOrFail($id); 
        $products = Products::select('product_id', 'product_name', 'normal_price')->get(); 
    
        return view('admin_dashboard.edit_sales', compact('sale', 'products'));
    }
    




    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'end_date' => 'required|date',
            'products.*.product_id' => 'required|string',
            'products.*.normal_price' => 'required|numeric',
            'products.*.sale_rate' => 'required|numeric|min:0|max:100',
        ]);

        $sale = Sale::findOrFail($id);
        $sale->end_date = $validatedData['end_date'];

        if (now()->lt($sale->end_date)) {
            $sale->status = 'active';
        }

        $productData = $validatedData['products'][0];
        $sale->sale_rate = $productData['sale_rate'];
        $sale->save();

        $sale->product()->updateOrCreate(
            ['product_id' => $productData['product_id']],
            [
                'normal_price' => $productData['normal_price'],
                'sale_rate' => $productData['sale_rate'],
                'sale_price' => $productData['normal_price'] - ($productData['normal_price'] * ($productData['sale_rate'] / 100)),
            ]
        );

        return redirect()->route('flash_sales')->with('status', 'Sale updated successfully.');
    }

    
    
    


    // Delete a sale
    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);
        $sale->delete();

        return redirect()->route('flash_sales')->with('status', 'Sale deleted successfully.');
    }


    public function saleProducts(Request $request)
    {
        $perPage = 24; 
    
        // Fetch sales with products and their reviews
        $sales = Sale::with(['product.images'])
            ->where('status', 'active')
            ->paginate($perPage)
            ->through(function ($sale) {
                $sale->average_rating = $sale->product->reviews()
                    ->where('status', 'published')
                    ->avg('rating');
                $sale->rating_count = $sale->product->reviews()
                    ->where('status', 'published')
                    ->count();
                return $sale;
            });
    
        if ($request->ajax()) {
            return view('partials.sale_products', compact('sales'));
        }
    
        return view('flash_sale', compact('sales'));
    }
    

}
