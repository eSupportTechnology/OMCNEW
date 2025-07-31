<?php

namespace App\Http\Controllers;
use App\Models\Products;
use App\Models\ShippingCharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{



    public function buyNowCheckout(Request $request)
    {
        Log::info('Buy Now Checkout request:', [
            'product_id' => $request->product_id,
            'size' => $request->size,
            'color' => $request->color,
            'quantity' => $request->quantity,
        ]);

        // Validate the incoming data
        $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'size' => 'nullable',
            'color' => 'nullable',
            'quantity' => 'required|integer|min:1',
        ]);

        // Retrieve product details from the database
        $product = Products::where('product_id', $request->product_id)->first();

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        Log::info('Product details:', [
            'product_id' => $product->product_id,
            'product_name' => $product->product_name,
        ]);

        // Calculate the price based on sale or normal price
        $price = $product->sale && $product->sale->status === 'active'
            ? $product->sale->sale_price
            : ($product->specialOffer && $product->specialOffer->status === 'active'
                ? $product->specialOffer->offer_price
                : $product->normal_price);

        // Store the product data in session
        Session::put('product_data', [
            'product_id' => $product->product_id,
            'product_name' => $product->product_name,
            'price' => $price,
            'size' => $request->size,
            'color' => $request->color,
            'quantity' => $request->quantity
        ]);

        // Return redirect URL to the checkout page
        return response()->json([
            'redirect_url' => route('buynow.checkout.page')
        ]);
    }




    public function showCheckoutPage()
{
    // Retrieve product data from session
    $productData = session('product_data');

    if (!$productData) {
        return redirect()->route('home')->with('error', 'No product selected for checkout');
    }

    $quantity = $productData['quantity'] ?? 1;

    // Find matching shipping charge
    $shippingCharge = ShippingCharge::where('min_quantity', '<=', $quantity)
                    ->where('max_quantity', '>=', $quantity)
                    ->first();

    $deliveryFee = $shippingCharge->charge ?? 0;

    $defaultAddress = auth()->user()->addresses()->first();

    return view('frontend.buynowcheckout', compact('productData', 'defaultAddress', 'deliveryFee'));
}


}
