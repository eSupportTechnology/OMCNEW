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

        $products = Products::where('product_name', 'like', "%{$query}%")
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

        // 2. Get Categories that have matching products
        // $categories = Category::whereHas('products', function ($q) use ($query) {
        //     $q->where('product_name', 'like', '%' . $query . '%');
        // })
        //     ->limit(8)
        //     ->get()
        //     ->map(function ($cat) {
        //         return [
        //             'name' => $cat->parent_category ?? 'Unnamed',
        //             'url' => url('/all-items?category=' . urlencode($cat->parent_category)),
        //         ];
        //     });

        $categories = Products::where('product_name', 'like', "%{$query}%")
            ->with(['images', 'category'])
            ->limit(10)
            ->get()
            ->map(function ($product) {
                return [
                    'name' => $product->product_category ?? 'Unnamed',
                    'url' => url('/all-items?category=' . urlencode($product->product_category)),
                ];
            })
            ->unique('name') // Remove duplicates based on category name
            ->values(); // Reset array keys



        return response()->json([
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}