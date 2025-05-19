<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function showbrands()
    {
        $brands = Brand::all();

        return view('admin_dashboard.brands_list', compact('brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string|unique:brands,slug',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('brands', 'public');
        }

        Brand::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'image' => $imagePath,
            'is_top_brand' => $request->has('is_top_brand'),
        ]);

        return response()->json(['success' => true]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string|unique:brands,slug,' . $id,
            'image' => 'nullable|image|max:2048',
        ]);

        $brand = Brand::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($brand->image) {
                \Storage::disk('public')->delete($brand->image);
            }
            $brand->image = $request->file('image')->store('brands', 'public');
        }

        $brand->name = $request->name;
        $brand->slug = $request->slug;
        $brand->is_top_brand = $request->has('is_top_brand');
        $brand->save();

        return back()->with('success', 'Brand updated successfully!');
    }
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);

        if ($brand->image) {
            \Storage::disk('public')->delete($brand->image);
        }

        $brand->delete();

        return back()->with('success', 'Brand image deleted successfully!');
    }

    public function edit($brandId)
    {

        $brand  = Brand::findOrFail($brandId);
        return view('admin_dashboard.edit_brand', compact('brand'));
    }

    public function getBrands()
    {
        $brands = Brand::select('name', 'slug', 'image', 'is_top_brand')->get();

        return response()->json($brands);
    }

    public function showBrandProducts($slug)
    {
        $brand = Brand::where('slug', $slug)->firstOrFail();
        $products = $brand->products()->paginate(20);

        $categories = Category::all();

        return view('frontend.brand-items', compact('brand', 'products', 'categories'));
    }

    public function ajaxBrandProducts(Request $request, $slug)
    {
        $brand = Brand::where('slug', $slug)->firstOrFail();

        $products = $brand->products();

        // Category filter
        if ($request->has('category_id') && $request->category_id != '') {
            $products->where('category_id', $request->category_id);
        }

        // Sorting
        if ($request->has('sort_by')) {
            switch ($request->sort_by) {
                case '1': // Price Low to High
                    $products->orderBy('normal_price', 'asc');
                    break;
                case '2': // Price High to Low
                    $products->orderBy('normal_price', 'desc');
                    break;
                case '4': // New Arrivals
                    $products->orderBy('created_at', 'desc');
                    break;
            }
        }

        $products = $products->with('images')->get();

        return response()->json([
            'products' => $products,
        ]);
    }
}
