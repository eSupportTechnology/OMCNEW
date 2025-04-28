<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\SubSubcategory;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{


        public function showCategories()
    {
        $categories = Category::with('subcategories.subSubcategories')->get();
        
        return view('admin_dashboard.category', compact('categories'));
    }



    public function store(Request $request)
{
    $request->validate([
        'parent_category' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'subcategories.*.name' => 'nullable|string|max:255',
        'subcategories.*.sub_subcategories.*.name' => 'nullable|string|max:255',
    ]);

    $imageName = null;

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->storeAs('category_images', $imageName, 'public');
    }

    $parentCategory = Category::create([
        'parent_category' => $request->input('parent_category'),
        'image' => $imageName, 
    ]);

    $subcategories = $request->input('subcategories', []);

    foreach ($subcategories as $subcategoryData) {
        if (isset($subcategoryData['name'])) {
            $subCat = Subcategory::create([
                'category_id' => $parentCategory->id,
                'subcategory' => $subcategoryData['name'],
            ]);

            if (isset($subcategoryData['sub_subcategories'])) {
                foreach ($subcategoryData['sub_subcategories'] as $subSubcategoryData) {
                    if (isset($subSubcategoryData['name'])) {
                        SubSubcategory::create([
                            'subcategory_id' => $subCat->id,
                            'sub_subcategory' => $subSubcategoryData['name'],
                        ]);
                    }
                }
            }
        }
    }

    return redirect()->route('category')->with('status', 'Category added successfully.');
}


    


    public function destroy($id)
    {
        $parentCategory = Category::find($id);
    
        if (!$parentCategory) {
            return response()->json(['status' => false, 'message' => 'Category not found.'], 404);
        }
    
        $parentCategory->subcategories()->each(function ($subcategory) {
            $subcategory->subSubcategories()->delete(); 
            $subcategory->delete(); 
        });
    
        $parentCategory->delete();
    
        return response()->json(['status' => true, 'message' => 'Category and its subcategories deleted successfully.']);
    }


    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $subcategories = $category->subcategories; 
        $subSubcategories = [];

        foreach ($subcategories as $subcategory) {
            $subSubcategories[$subcategory->id] = $subcategory->subSubcategories; 
        }

        return view('admin_dashboard.edit_category', [
            'category' => $category,
            'subcategories' => $subcategories,
            'subSubcategories' => $subSubcategories
        ]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'parent_category' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'subcategories.*.name' => 'nullable|string|max:255',
            'subcategories.*.sub_subcategories.*.name' => 'nullable|string|max:255',
        ]);
    
        $category = Category::findOrFail($id);
    
        $imageName = $category->image;
    
        if ($request->hasFile('image')) {
            if ($category->image) {
                Storage::disk('public')->delete('category_images/' . $category->image);
            }
    
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('category_images', $imageName, 'public');
        }
    
        $category->update([
            'parent_category' => $request->input('parent_category'),
            'image' => $imageName,
        ]);
    
        $existingSubcategories = Subcategory::where('category_id', $category->id)->get()->keyBy('id');
    
        $subcategories = $request->input('subcategories', []);
        $updatedSubcategoryIds = [];
    
        foreach ($subcategories as $subcategoryData) {
            if (isset($subcategoryData['name'])) {
                $subCat = Subcategory::updateOrCreate(
                    ['id' => $subcategoryData['id'] ?? null],
                    ['category_id' => $category->id, 'subcategory' => $subcategoryData['name']]
                );
    
                $updatedSubcategoryIds[] = $subCat->id;
    
                if (isset($subcategoryData['sub_subcategories'])) {
                    foreach ($subcategoryData['sub_subcategories'] as $subSubcategoryData) {
                        if (isset($subSubcategoryData['name'])) {
                            SubSubcategory::updateOrCreate(
                                ['id' => $subSubcategoryData['id'] ?? null],
                                ['subcategory_id' => $subCat->id, 'sub_subcategory' => $subSubcategoryData['name']]
                            );
                        }
                    }
                }
            }
        }
    
        $deletedSubcategories = $existingSubcategories->except($updatedSubcategoryIds);
        foreach ($deletedSubcategories as $subcategory) {
            SubSubcategory::where('subcategory_id', $subcategory->id)->delete();
            $subcategory->delete();
        }
    
        return redirect()->route('category')->with('status', 'Category updated successfully.');
    }
    


        
}
