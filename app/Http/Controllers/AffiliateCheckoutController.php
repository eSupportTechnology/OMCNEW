<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class AffiliateCheckoutController extends Controller
{
    public function showCheckout(Request $request)
    {
        $productId = $request->query('product_id');
        $selectedSize = $request->query('size', '');   // Get from query, default empty
        $selectedColor = $request->query('color', ''); // Get from query, default empty

        $product = Products::where('product_id', $productId)->first();

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        $productData = [
            'product_id' => $product->product_id,
            'product_name' => $product->product_name,
            'price' => $product->affiliate_price ?? $product->total_price,
            'size' => $selectedSize ?: 'N/A',
            'color' => $selectedColor ?: 'N/A',
            'image' => $product->images->isNotEmpty() ? $product->images->first()->image_path : null,
            'quantity' => 1,
        ];

        return view('affiliate_dashboard.checkout', compact('productData'));
    }
}
