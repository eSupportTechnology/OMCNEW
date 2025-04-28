<?php

namespace App\Http\Controllers;
use App\Models\Products;
use App\Models\CustomerOrderItems;
use App\Models\SpecialOffers;
use App\Models\Category;
use App\Models\Variation;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class SpecialOffersController extends Controller
{

    // Show the form to create offers
    public function createOffer()
    {
        $activeSales = Sale::where('status', 'active')->pluck('product_id')->toArray();
        $specialOffers = SpecialOffers::where('status', 'active')->pluck('product_id')->toArray();

        $excludedProductIds = array_merge($activeSales, $specialOffers);
        $products = Products::select('product_id', 'product_name', 'normal_price')
                            ->whereNotIn('product_id', $excludedProductIds)
                            ->get();

        return view('admin_dashboard.add_offers', compact('products'));
    }




    public function showOffers()
    {
        $offers = SpecialOffers::with(['product.images'])->get(); 
        return view('admin_dashboard.special_offers', compact('offers'));
    }
    

    
    public function storeOffer(Request $request)
    {
     
            $data = $request->validate([
                'month_year' => 'required',
                'products' => 'required|array',
                'products.*.product_id' => 'required|exists:products,product_id',
                'products.*.normal_price' => 'required|numeric',
                'products.*.offer_rate' => 'required|numeric|min:0|max:100',
                'products.*.offer_price' => 'required|numeric',
            ]);
    
            foreach ($data['products'] as $product) {
                SpecialOffers::create([
                    'product_id' => $product['product_id'],
                    'normal_price' => $product['normal_price'],
                    'offer_rate' => $product['offer_rate'],
                    'offer_price' => $product['offer_price'],
                    'month' => $data['month_year'],
                    'status' => 'active',
                ]);
            }
    
            return redirect()->route('special_offers')->with('status', 'Special offers added successfully!');
            return redirect()->back()->withErrors('There was an error while saving the offers. Please try again.');
        }

    
        public function edit($id)
        {
            $offer = SpecialOffers::with('product')->findOrFail($id);
            return view('admin_dashboard.edit_offers', compact('offer'));
        }
        

        public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'month' => 'required|date_format:Y-m',
            'offer_rate' => 'required|numeric|min:0|max:100',
            'status' => 'required|in:Active,Inactive',
        ]);

        $offer = SpecialOffers::findOrFail($id);
        $offer->month = $validatedData['month'];
        $offer->offer_rate = $validatedData['offer_rate'];
        $offer->status = $validatedData['status'];

        $normalPrice = $offer->normal_price;
        $offerPrice = $normalPrice - ($normalPrice * ($offer->offer_rate / 100));
        $offer->offer_price = $offerPrice;

        $offer->save();

        return redirect()->route('special_offers')->with('status', 'Offer updated successfully.');
    }


    public function destroy($id)
    {
        $offer = SpecialOffers::findOrFail($id);
        $offer->delete();

        return redirect()->route('special_offers')->with('status', 'Product deleted successfully.');
    }



    public function showProductsWithSpecialOffers(Request $request)
    {
        $perPage = 18;
    
        // Get categories for the filter
        $categories = Category::all();
    
        // Initialize the base query
        $query = Products::with(['specialOffer' => function ($query) {
            $query->where('status', 'active');
        }, 'images'])
        ->whereHas('specialOffer', function ($query) {
            $query->where('status', 'active');
        });
    
        // Apply category filter
        if ($request->has('category')) {
            $category = $request->input('category');
            $query->where('product_category', $category);
        }
    
        // Apply color filter
        if ($request->has('color')) {
            $color = $request->input('color');
            $query->whereHas('variations', function ($q) use ($color) {
                $q->where('type', 'color')->where('value', $color);
            });
        }
    
        // Apply size filter
        if ($request->has('size')) {
            $size = $request->input('size');
            $query->whereHas('variations', function ($q) use ($size) {
                $q->where('type', 'size')->where('value', $size);
            });
        }
    
        // Apply price filter
        if ($request->has('price')) {
            $priceRange = explode('-', $request->input('price'));
            $minPrice = $priceRange[0];
            $maxPrice = $priceRange[1];
            $query->whereBetween('normal_price', [$minPrice, $maxPrice]);
        }
    
        // Paginate the results
        $products = $query->paginate($perPage)->through(function ($product) {
            // Calculate average rating and rating count
            $product->average_rating = $product->reviews()->where('status', 'published')->avg('rating');
            $product->rating_count = $product->reviews()->where('status', 'published')->count();
            return $product;
        });
    
        $sizes = Variation::where('type', 'size')->distinct()->get(['value']);
        $colors = Variation::where('type', 'color')->distinct()->get(['value', 'hex_value']);
    
        return view('frontend.special-offers', compact('products', 'categories', 'sizes', 'colors'));
    }
    

    public function bestSellers(Request $request)
    {
        // Get the most ordered products along with their quantities
        $orderedProducts = CustomerOrderItems::select('product_id')
            ->selectRaw('SUM(quantity) as total_quantity') 
            ->groupBy('product_id') 
            ->orderBy('total_quantity', 'desc')
            ->pluck('product_id'); 
    
        // Initialize the base query for products
        $query = Products::with('images')
            ->whereIn('product_id', $orderedProducts)
            ->with(['reviews' => function($query) {
                $query->where('status', 'published');
            }]);
    
        // Apply category filter
        if ($request->has('category')) {
            $category = $request->input('category');
            $query->where('product_category', $category);
        }
    
        // Apply color filter
        if ($request->has('color')) {
            $color = $request->input('color');
            $query->whereHas('variations', function ($q) use ($color) {
                $q->where('type', 'color')->where('value', $color);
            });
        }
    
        // Apply size filter
        if ($request->has('size')) {
            $size = $request->input('size');
            $query->whereHas('variations', function ($q) use ($size) {
                $q->where('type', 'size')->where('value', $size);
            });
        }
    
        // Apply price filter
        if ($request->has('price')) {
            $priceRange = explode('-', $request->input('price'));
            $minPrice = $priceRange[0];
            $maxPrice = $priceRange[1];
            $query->whereBetween('normal_price', [$minPrice, $maxPrice]);
        }
    
        // Paginate the filtered results
        $perPage = 18; // Set the pagination limit
        $products = $query->paginate($perPage);
    
        // Add ratings to each product
        foreach ($products as $product) {
            $product->average_rating = $product->reviews->avg('rating');
            $product->rating_count = $product->reviews->count();
        }
    
        // Get categories for the filter
        $categories = Category::all();
        $sizes = Variation::where('type', 'size')->distinct()->get(['value']);
        $colors = Variation::where('type', 'color')->distinct()->get(['value', 'hex_value']);
    
        return view('frontend.best-seller', compact('products', 'categories', 'sizes', 'colors'));
    }
    
    
    
    
    
}
