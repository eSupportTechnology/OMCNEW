<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function suggestions(Request $request)
{
    $query = $request->input('q');

    $products = Products::where(function ($q) use ($query) {
            $q->where('product_name', 'like', "%{$query}%")
              ->orWhere('subcategory', 'like', "%{$query}%")
              ->orWhere('product_category', 'like', "%{$query}%")
              ->orWhere('sub_subcategory', 'like', "%{$query}%");
        })
        ->with(['images', 'category'])
        ->limit(10)
        ->get()
        ->map(function ($product) {
            return [
                'name' => $product->product_name,
                'image' => $product->images->first() ? asset('storage/' . $product->images->first()->image_path) : 'default.jpg',
                'url' => url('/product-description/' . $product->product_id),
                'category' => $product->product_category ?? 'Unnamed',
                'category_url' => url('/all-items?category=' . urlencode($product->product_category)),
            ];
        });

    // Optional: Suggest unique categories based on search
    $categories = Products::where(function ($q) use ($query) {
            $q->where('product_name', 'like', "%{$query}%")
              ->orWhere('subcategory', 'like', "%{$query}%")
              ->orWhere('product_category', 'like', "%{$query}%")
              ->orWhere('sub_subcategory', 'like', "%{$query}%");
        })
        ->limit(10)
        ->get()
        ->map(function ($product) {
            return [
                'name' => $product->product_category ?? 'Unnamed',
                'url' => url('/all-items?category=' . urlencode($product->product_category)),
            ];
        })
        ->unique('name')
        ->values();

    return response()->json([
        'products' => $products,
        'categories' => $categories,
    ]);
}

}
