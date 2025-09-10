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
        Log::info('Buy Now Checkout request:', $request->all());

        $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'size' => 'nullable|string',
            'color' => 'nullable|string',
            'material' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Products::with('variations')->where('product_id', $request->product_id)->first();

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Check each variation independently
        $sizeVar = $request->size ? $product->variations()->where('type', 'Size')->where('value', $request->size)->first() : null;
        $colorVar = $request->color ? $product->variations()->where('type', 'Color')->where('value', $request->color)->first() : null;
        $materialVar = $request->material ? $product->variations()->where('type', 'Material')->where('value', $request->material)->first() : null;

        if (($sizeVar && $sizeVar->quantity < $request->quantity) ||
            ($colorVar && $colorVar->quantity < $request->quantity) ||
            ($materialVar && $materialVar->quantity < $request->quantity) ||
            (!$sizeVar && !$colorVar && !$materialVar && $product->quantity < $request->quantity)
        ) {
            return response()->json(['message' => 'Selected variation is out of stock'], 422);
        }

        // Price calculation
        $price = $product->sale && $product->sale->status === 'active'
            ? $product->sale->sale_price
            : ($product->specialOffer && $product->specialOffer->status === 'active'
                ? $product->specialOffer->offer_price
                : $product->normal_price);

        // Store in session
        Session::put('product_data', [
            'product_id' => $product->product_id,
            'product_name' => $product->product_name,
            'price' => $price,
            'size' => $request->size,
            'color' => $request->color,
            'material' => $request->material,
            'quantity' => $request->quantity
        ]);

        return response()->json(['redirect_url' => route('buynow.checkout.page')]);
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
