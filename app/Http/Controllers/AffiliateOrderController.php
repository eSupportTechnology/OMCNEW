<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Products;
use App\Models\Variation;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderItems;

class AffiliateOrderController extends Controller
{
    public function buynowstore(Request $request)
    {

        


        
        
        try {
            // ✅ Validate the request
            $request->validate([
                'first_name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'email' => 'required|email|max:255',
                'address' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'postal_code' => 'required|string|max:10',
                'company_name' => 'nullable|string|max:255',
                'apartment' => 'nullable|string|max:255',
                'size' => 'nullable|string|max:255',  
                'color' => 'nullable|string|max:255', 
                'quantity' => 'required|integer|min:1',  
            ]);

            $product = Products::where('product_id', $request->product_id)->first();

            $quantity = $request->input('quantity', 1);
            $price = $product->sale && $product->sale->status === 'active'
                ? $product->sale->sale_price
                : ($product->specialOffer && $product->specialOffer->status === 'active'
                    ? $product->specialOffer->offer_price
                    : $product->normal_price);

            $subtotal = $price * $quantity;
            $shipping = 300;
            $total = $subtotal + $shipping;

            $orderCode = 'ORD-' . substr((string) Str::uuid(), 0, 8);

            $orderData = [
                'order_code' => $orderCode,
                'customer_fname' => $request->input('first_name'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'company_name' => $request->input('company_name'),
                'address' => $request->input('address'),
                'apartment' => $request->input('apartment'),
                'city' => $request->input('city'),
                'postal_code' => $request->input('postal_code'),
                'date' => Carbon::now()->format('Y-m-d'),
                'total_cost' => $total,
                'discount' => 0,
                'user_id' => Session::get('customer_id'), // ✅ Affiliate user
                'status' => 'Confirmed',
            ];

            CustomerOrder::create($orderData);

            CustomerOrderItems::create([
                'order_code' => $orderCode,
                'product_id' => $product->product_id,
                'date' => Carbon::now()->format('Y-m-d'),
                'cost' => $price,
                'quantity' => $quantity,
                'size' => $request->input('size'),
                'color' => $request->input('color'),
            ]);

            $product->quantity -= $quantity;
            $product->save();

            $sizeVariation = Variation::where('product_id', $product->product_id)
                ->where('type', 'size')
                ->where('value', $request->input('size'))
                ->first();

            if ($sizeVariation && $sizeVariation->quantity >= $quantity) {
                $sizeVariation->quantity -= $quantity;
                $sizeVariation->save();
            } elseif ($sizeVariation) {
                Log::warning('Not enough size variation quantity', [
                    'product_id' => $product->product_id,
                    'size' => $request->input('size'),
                    'required_quantity' => $quantity,
                    'available_quantity' => $sizeVariation->quantity
                ]);
            }

            $colorVariation = Variation::where('product_id', $product->product_id)
                ->where('type', 'color')
                ->where('value', $request->input('color'))
                ->first();

            if ($colorVariation && $colorVariation->quantity >= $quantity) {
                $colorVariation->quantity -= $quantity;
                $colorVariation->save();
            } elseif ($colorVariation) {
                Log::warning('Not enough color variation quantity', [
                    'product_id' => $product->product_id,
                    'color' => $request->input('color'),
                    'required_quantity' => $quantity,
                    'available_quantity' => $colorVariation->quantity
                ]);
            }

            return redirect()->route('affiliate.payment', ['order_code' => $orderCode]);

        } catch (\Exception $e) {
            Log::error('Error processing Buy Now order', [
                'exception' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->with('error', 'An error occurred while processing your order. Please try again.');
        }
    }
}
