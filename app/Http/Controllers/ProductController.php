<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Products;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\SpecialOffers;
use App\Models\Review;
use App\Models\Sale;
use App\Models\Variation;
use App\Models\VariationImage;
use App\Models\SubSubcategory;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use App\Models\ProductQuestion;


class ProductController extends Controller
{


    public function showProductsByCategory($category = null, $subcategory = null, $subsubcategory = null)
    {
        $perPage = 16;
        $query = Products::with('images', 'specialOffer', 'Sale');

        if ($subsubcategory) {
            $query->where('sub_subcategory', $subsubcategory);
        } elseif ($subcategory) {
            $query->where('subcategory', $subcategory);
        } elseif ($category) {
            $query->where('product_category', $category);
        }

        $products = $query->paginate($perPage)->through(function ($product) {
            $product->average_rating = $product->reviews()->where('status', 'published')->avg('rating');
            $product->rating_count = $product->reviews()->where('status', 'published')->count();
            return $product;
        });

        $colors = Variation::where('type', 'color')->distinct()->get(['value', 'hex_value']);

        if (request()->ajax()) {
            return view('partials.products', compact('products', 'colors'));
        }

        return view('user_products', [
            'products' => $products,
            'category' => $category,
            'subcategory' => $subcategory,
            'subsubcategory' => $subsubcategory,
            'colors' => $colors,
        ]);
    }


    public function show_all_items(Request $request)
    {
        $perPage = 15;
        // Get categories for the filter
        $categories = Category::all();

        $query = Products::with('images', 'specialOffer', 'Sale');

        // Apply category filter
        if ($request->has('category')) {
            $category = $request->input('category');
            $query->where('product_category', $category);
        }

        // Apply subcategory filter
        if ($request->has('subcategory')) {
            $subcategory = $request->input('subcategory');
            $query->where('subcategory', $subcategory);
        }

        // Apply subsubcategory filter
        if ($request->has('subsubcategory')) {
            $subsubcategory = $request->input('subsubcategory');
            $query->where('sub_subcategory', $subsubcategory);
        }

        // Apply other filters (color, size, price)
        if ($request->has('color')) {
            $color = $request->input('color');
            $query->whereHas('variations', function ($q) use ($color) {
                $q->where('type', 'color')->where('value', $color);
            });
        }

        if ($request->has('size')) {
            $size = $request->input('size');
            $query->whereHas('variations', function ($q) use ($size) {
                $q->where('type', 'size')->where('value', $size);
            });
        }

        if ($request->has('price')) {
            $priceRange = explode('-', $request->input('price'));
            $minPrice = $priceRange[0];
            $maxPrice = $priceRange[1];
            $query->whereBetween('normal_price', [$minPrice, $maxPrice]);
        }

        // Paginate the results
        $products = $query->paginate($perPage)->through(function ($product) {
            $product->average_rating = $product->reviews()->where('status', 'published')->avg('rating');
            $product->rating_count = $product->reviews()->where('status', 'published')->count();
            return $product;
        });

        $sizes = Variation::where('type', 'size')->distinct()->get(['value']);
        $colors = Variation::where('type', 'color')->distinct()->get(['value', 'hex_value']);

        return view('frontend.all_items', compact('products', 'categories', 'sizes', 'colors'));
    }






    public function filterProducts(Request $request)
    {
        $query = Products::with(['images', 'specialOffer']);

        if (!empty($request->category)) {
            $query->where('product_category', $request->category);
        }

        if (!empty($request->subcategory)) {
            $query->where('subcategory', $request->subcategory);
        }

        if (!empty($request->subsubcategory)) {
            $query->where('sub_subcategory', $request->subsubcategory);
        }

        if (!empty($request->selectedSizes)) {
            $query->whereHas('variations', function ($q) use ($request) {
                $q->whereIn('value', $request->selectedSizes)->where('type', 'size');
            });
        }

        if (!empty($request->selectedColors)) {
            $query->whereHas('variations', function ($q) use ($request) {
                $q->whereIn('hex_value', $request->selectedColors)
                  ->where('type', 'color');
            });
        }


        if (!empty($request->selectedRatings)) {
            $query->whereHas('reviews', function ($q) use ($request) {
                $q->selectRaw('product_id, AVG(rating) as avg_rating')
                ->groupBy('product_id')
                ->havingRaw('AVG(rating) >= ?', [min($request->selectedRatings)]);
            });
        }

        if ($request->priceMin) {
            $query->where(function ($q) use ($request) {
                $q->where('normal_price', '>=', $request->priceMin)
                    ->orWhereHas('specialOffer', function ($q) use ($request) {
                        $q->where('offer_price', '>=', $request->priceMin);
                    })
                    ->orWhereHas('sale', function ($q) use ($request) {
                        $q->where('sale_price', '>=', $request->priceMin);
                    });
            });
        }

        if ($request->priceMax) {
            $query->where(function ($q) use ($request) {
                $q->where('normal_price', '<=', $request->priceMax)
                    ->orWhereHas('specialOffer', function ($q) use ($request) {
                        $q->where('offer_price', '<=', $request->priceMax);
                    })
                    ->orWhereHas('sale', function ($q) use ($request) {
                        $q->where('sale_price', '<=', $request->priceMax);
                    });
            });
        }

        $products = $query->get();

        return response()->json(['products' => $products]);
    }







    public function show(
        $product_id
    ) {
        $product = Products::with('images')->where('product_id', $product_id)->firstOrFail();

        $specialOffer = SpecialOffers::where('product_id', $product_id)
            ->where('status', 'active')
            ->first();

        $sale = Sale::where('product_id', $product_id)
            ->where('status', 'active')
            ->first();

        $relatedProducts = Products::where('product_category', $product->product_category)
            ->where('product_id', '!=', $product->product_id)
            ->take(15)
            ->get();

        foreach ($relatedProducts as $relatedProduct) {
            $offer = SpecialOffers::where('product_id', $relatedProduct->product_id)
                ->where('status', 'active')
                ->first();

            $relatedProduct->offer_price = $offer ? $offer->offer_price : null;
        }

        $reviews = Review::with('media')->where('product_id', $product_id)
            ->where('status', 'published')
            ->get();

        $averageRating = $reviews->avg('rating');
        $totalReviews = $reviews->count();

        $ratingsCount = [
            '5' => Review::where('product_id', $product_id)->where('rating', 5)->count(),
            '4' => Review::where('product_id', $product_id)->where('rating', 4)->count(),
            '3' => Review::where('product_id', $product_id)->where('rating', 3)->count(),
            '2' => Review::where('product_id', $product_id)->where('rating', 2)->count(),
            '1' => Review::where('product_id', $product_id)->where('rating', 1)->count(),
        ];

        $questions = ProductQuestion::where('product_id', $product->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('frontend.product-description', compact('product', 'relatedProducts', 'reviews', 'averageRating', 'totalReviews', 'ratingsCount', 'specialOffer', 'sale', 'questions'));
    }

    // Store a new question from user
    public function storeQuestion(Request $request, $product_id)
    {
        $request->validate([
            'question' => 'required|string|max:1000',
        ]);
        $product = Products::where('product_id', $product_id)->firstOrFail();
        $question = new ProductQuestion();
        $question->product_id = $product->id;
        $question->user_id = auth()->check() ? auth()->id() : null;
        $question->question = $request->question;
        $question->status = 'pending';
        $question->save();
        return back()->with('success', 'Your question has been submitted and is awaiting admin response.');
    }

    // Admin: answer a question
    public function answerQuestion(Request $request, $question_id)
    {
        $request->validate([
            'answer' => 'required|string|max:2000',
        ]);
        $question = ProductQuestion::findOrFail($question_id);
        $question->answer = $request->answer;
        $question->status = 'answered';
        $question->save();
        return back()->with('success', 'Answer submitted successfully.');
    }

    // Admin: delete product question answer
    public function deleteAnswer($question_id)
    {
        $question = ProductQuestion::findOrFail($question_id);
        $question->answer = null;
        $question->status = 'pending';
        $question->save();
        return back()->with('success', 'Answer deleted and question set to pending.');
    }


    //admin products

    public function showProducts()
    {
        $categories = Category::all();
        $products = Products::with(['category', 'images'])->get();

        return view('admin_dashboard.products', compact('categories', 'products'));
    }



    public function edit($id)
    {
        $product = Products::findOrFail($id);
        $categories = Category::all();

        $selectedCategoryId = Category::where('parent_category', $product->product_category)->value('id');
        $selectedSubcategoryId = Subcategory::where('subcategory', $product->subcategory)->value('id');
        $subcategories = $selectedCategoryId ? Subcategory::where('category_id', $selectedCategoryId)->get() : collect();
        $subSubcategories = $selectedSubcategoryId ? SubSubcategory::where('subcategory_id', $selectedSubcategoryId)->get() : collect();

        $variations = Variation::where('product_id', $product->product_id)->get();

        $brands = Brand::all();
        return view('admin_dashboard.edit_products', compact('product', 'categories', 'subcategories', 'subSubcategories', 'selectedCategoryId', 'selectedSubcategoryId', 'variations', 'brands'));
    }



    public function destroy($id)
    {
        $product = Products::findOrFail($id);
        $product->delete();

        return redirect()->route('products')->with('status', 'Product deleted successfully.');
    }





    public function update(Request $request, $id)
    {
        $request->merge([
            'affiliateProduct' => $request->has('affiliateProduct') ? true : false,
        ]);

            $validatedData = $request->validate([
                'productName' => 'required|string|max:255',
                'productDesc' => 'required|string',
                'productImages.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'normalPrice' => 'required|numeric|min:0',
                'affiliateProduct' => 'nullable|boolean',
                'affiliatePrice' => 'nullable|numeric|min:0',
                'commissionPercentage' => 'nullable|numeric|min:0|max:100',
                'totalPrice' => 'required|numeric|min:0',
                'quantity' => 'nullable|numeric|min:0',
                'category' => 'required|integer|exists:categories,id',
                'subcategory' => 'nullable|integer|exists:subcategories,id',
                'subsubcategory' => 'nullable|integer|exists:sub_subcategories,id',
                'deleteImages' => 'nullable|array',
                'deleteImages.*' => 'nullable|numeric|exists:product_images,id',
                'variation' => 'nullable|array',
                'variation.*.id' => 'nullable|integer|exists:variations,id',
                'variation.*.type' => 'nullable|string',
                'variation.*.value' => 'nullable|string',
                'variation.*.quantity' => 'nullable|numeric|min:0',
                'tags' => 'nullable|string',
                'brand_id' => 'nullable',
            ]);

            $request->merge([
                'tags' => $request->input('tags') ? implode(',', array_map('trim', explode(',', $request->input('tags')))) : '',
            ]);

            $product = Products::findOrFail($id);

            $categoryName = Category::find($validatedData['category'])->parent_category ?? '';
            $subcategoryName = Subcategory::find($validatedData['subcategory'])->subcategory ?? '';
            $subsubcategoryName = SubSubcategory::find($validatedData['subsubcategory'])->sub_subcategory ?? '';

            $product->update([
                'product_name' => $validatedData['productName'],
                'product_description' => $validatedData['productDesc'],
                'normal_price' => $validatedData['normalPrice'],
                'is_affiliate' => $request->input('affiliateProduct'),
                'affiliate_price' => $validatedData['affiliatePrice'] ?? null,
                'commission_percentage' => $validatedData['commissionPercentage'] ?? null,
                'total_price' => $validatedData['totalPrice'],
                'quantity' => $validatedData['quantity'],
                'tags' => $validatedData['tags'],
                'product_category' => $categoryName,
                'subcategory' => $subcategoryName,
                'sub_subcategory' => $subsubcategoryName,
                'brand_id' => $validatedData['brand_id'],
            ]);

            // Handle image deletions
            if ($request->has('deleteImages')) {
                foreach ($request->input('deleteImages') as $imageId) {
                    $image = ProductImage::find($imageId);
                    if ($image) {
                        if (Storage::exists('public/' . $image->image_path)) {
                            Storage::delete('public/' . $image->image_path);
                        }
                        $image->delete();
                    }
                }
            }

            // Handle new images
            if ($request->hasFile('productImages')) {
                foreach ($request->file('productImages') as $image) {
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $imagePath = $image->storeAs('product_images', $imageName, 'public');

                    ProductImage::create([
                        'product_id' => $product->product_id,
                        'image_path' => $imagePath,
                    ]);
                }
            }
            // Handle variations
            $existingVariationIds = $product->variations->pluck('id')->toArray();
            $submittedVariationIds = array_column($request->input('variation', []), 'id');

            $client = new Client();

            foreach ($request->input('variation', []) as $variation) {
                if ($variation['type'] === 'Color') {
                    $hexValue = $variation['value'];
                    $colorName = 'Unknown Color';


                        $response = $client->get('https://www.thecolorapi.com/id?hex=' . ltrim($hexValue, '#'));
                        $data = json_decode($response->getBody(), true);
                        $colorName = $data['name']['value'] ?? 'Unknown Color';

                    // Check for existing variation and update
                    if (isset($variation['id']) && in_array($variation['id'], $existingVariationIds)) {
                        $existingVariation = Variation::find($variation['id']);
                        if ($existingVariation) {
                            $existingVariation->update([
                                'type' => $variation['type'],
                                'value' => $colorName,
                                'hex_value' => $hexValue,
                                'quantity' => $variation['quantity'],
                            ]);
                        }
                    } else {
                        if (isset($variation['quantity']) && $variation['quantity'] > 0) {
                            Variation::create([
                                'product_id' => $product->product_id,
                                'type' => $variation['type'],
                                'value' => $colorName,
                                'hex_value' => $hexValue,
                                'quantity' => $variation['quantity'],
                            ]);
                        }
                    }
                } else {
                    // Handle non-color variations
                    if (isset($variation['id']) && in_array($variation['id'], $existingVariationIds)) {
                        $existingVariation = Variation::find($variation['id']);
                        if ($existingVariation) {
                            $existingVariation->update([
                                'type' => $variation['type'],
                                'value' => $variation['value'],
                                'hex_value' => null,
                                'quantity' => $variation['quantity'],
                            ]);
                        }
                    } else {
                        // Create a new variation for non-colors
                        if (isset($variation['quantity']) && $variation['quantity'] > 0) {
                            Variation::create([
                                'product_id' => $product->product_id,
                                'type' => $variation['type'],
                                'value' => $variation['value'],
                                'hex_value' => null,
                                'quantity' => $variation['quantity'],
                            ]);
                        }
                    }
                }
            }


            $variationsToDelete = array_diff($existingVariationIds, $submittedVariationIds);
            Variation::whereIn('id', $variationsToDelete)->delete();

            return redirect()->route('products')->with('status', 'Product updated successfully!');
    }





    public function store(Request $request)
    {
        $request->merge([
            'affiliateProduct' => $request->has('affiliateProduct') ? true : false,
            'tags' => $request->input('tags') ? implode(',', array_map('trim', explode(',', $request->input('tags')))) : '',
        ]);

        $request->validate([
            'productName' => 'required|string|max:255',
            'productDesc' => 'nullable|string',
            'productImages' => 'nullable|array',
            'productImages.*' => 'nullable|image|max:2048',
            'normalPrice' => 'required|numeric',
            'affiliateProduct' => 'required|boolean',
            'affiliatePrice' => 'nullable|numeric',
            'commissionPercentage' => 'nullable|numeric|min:0|max:100',
            'totalPrice' => 'required|numeric',
            'category' => 'required|string',
            'subcategory' => 'nullable|string',
            'subsubcategory' => 'nullable|string',
            'quantity' => 'nullable|numeric',
            'variation' => 'nullable|array',
            'variation.*.type' => 'nullable|string',
            'variation.*.value' => 'nullable|string',
            'variation.*.quantity' => 'nullable|numeric|min:0',
            'brand_id' => 'nullable',
        ]);


        $categoryName = Category::find($request->input('category'))->parent_category ?? '';
        $subcategoryName = Subcategory::find($request->input('subcategory'))->subcategory ?? '';
        $subsubcategoryName = SubSubcategory::find($request->input('subsubcategory'))->sub_subcategory ?? '';


        $product = Products::create([
            'product_name' => $request->input('productName'),
            'product_description' => $request->input('productDesc'),
            'normal_price' => $request->input('normalPrice'),
            'is_affiliate' => $request->input('affiliateProduct'),
            'affiliate_price' => $request->input('affiliatePrice'),
            'commission_percentage' => $request->input('commissionPercentage'),
            'total_price' => $request->input('totalPrice'),
            'product_category' => $categoryName,
            'subcategory' => $subcategoryName,
            'sub_subcategory' => $subsubcategoryName,
            'quantity' => $request->input('quantity'),
            'tags' => $request->input('tags'),
            'brand_id' => $request->input('brand_id'),
        ]);

        if ($request->hasFile('productImages')) {
            foreach ($request->file('productImages') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('product_images', $imageName, 'public');

                ProductImage::create([
                    'product_id' => $product->product_id,
                    'image_path' => $imagePath,
                ]);
            }
        }

    $variations = $request->input('variation', []);
    $client = new Client();

    foreach ($variations as $variation) {
        if ($variation['type'] === 'Color') {
            $hexValue = $variation['value'];

                $response = $client->get('https://www.thecolorapi.com/id?hex=' . ltrim($hexValue, '#'));
                $data = json_decode($response->getBody(), true);
                $colorName = $data['name']['value'] ?? 'Unknown Color';

            if (isset($variation['quantity']) && $variation['quantity'] > 0) {
                Variation::create([
                    'product_id' => $product->product_id,
                    'type' => $variation['type'],
                    'value' => $colorName,
                    'hex_value' => $hexValue,
                    'quantity' => $variation['quantity'],
                ]);
            }
        } else {
            if (isset($variation['quantity']) && $variation['quantity'] > 0) {
                Variation::create([
                    'product_id' => $product->product_id,
                    'type' => $variation['type'],
                    'value' => $variation['value'],
                    'hex_value' => null,
                    'quantity' => $variation['quantity'],
                ]);
            }
        }
        }

        return redirect()->route('products')->with('status', 'Product added successfully!');
    }






    public function showCategory(Request $request)
    {
        $categories = Category::all();

        $selectedCategoryId = old('category', $request->input('category'));
        $selectedSubcategoryId = old('subcategory', $request->input('subcategory'));
        $subcategories = $selectedCategoryId ? Subcategory::where('category_id', $selectedCategoryId)->get() : collect();

        $subSubcategories = $selectedSubcategoryId ? SubSubcategory::where('subcategory_id', $selectedSubcategoryId)->get() : collect();

        $brands = Brand::all();
        return view('admin_dashboard.add_products', compact('categories', 'subcategories', 'subSubcategories', 'selectedCategoryId', 'selectedSubcategoryId', 'brands'));
    }




    public function getSubcategories($categoryId)
    {
        $subcategories = Subcategory::where('category_id', $categoryId)->get(['id', 'subcategory as name']);
        return response()->json(['subcategories' => $subcategories]);
    }

    public function getSubSubcategories($subcategoryId)
    {
        $subSubcategories = SubSubcategory::where('subcategory_id', $subcategoryId)->get(['id', 'sub_subcategory as name']);
        return response()->json(['sub_subcategories' => $subSubcategories]);
    }


    public function showProductDetails($id)
    {
        $product = Products::with(['images', 'variations'])->findOrFail($id);
        return view('admin_dashboard.product-details', compact('product'));
    }



    public function showSearchResults(Request $request)
{
    $query = $request->get('query', '');
    $products = [];

    if (!empty($query)) {
        $searchTerms = explode(' ', $query);

        $products = Products::with(['Sale', 'specialOffer', 'images', 'category', 'category.subcategories', 'category.subcategories.subSubcategories'])
            ->where(function ($q) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    $q->where('product_name', 'LIKE', '%' . $term . '%') // Search in product name
                      ->orWhere('tags', 'LIKE', '%' . $term . '%')     // Search in tags
                      ->orWhereHas('category', function ($categoryQuery) use ($term) {
                          $categoryQuery->where('parent_category', 'LIKE', '%' . $term . '%'); // Search in parent category name
                      })
                      ->orWhereHas('category.subcategories', function ($subcategoryQuery) use ($term) {
                          $subcategoryQuery->where('subcategory', 'LIKE', '%' . $term . '%'); // Search in subcategory name
                      })
                      ->orWhereHas('category.subcategories.subSubcategories', function ($subSubcategoryQuery) use ($term) {
                          $subSubcategoryQuery->where('sub_subcategory', 'LIKE', '%' . $term . '%'); // Search in sub-subcategory name
                      });
                }
            })
            ->select('id', 'product_name', 'product_id', 'normal_price')
            ->paginate(10) // Paginate the results
            ->through(function ($product) {
                // Add the average rating and rating count to each product
                $product->average_rating = $product->reviews()->where('status', 'published')->avg('rating');
                $product->rating_count = $product->reviews()->where('status', 'published')->count();
                return $product;
            });
    }

    return view('frontend.search_results', compact('products', 'query'));
}





    public function searchProducts(Request $request)
    {
        $search = $request->get('search');

        if (!$search) {
            return response()->json([]);
        }

        $searchTerms = explode(' ', $search);
        $products = Products::query();

        foreach ($searchTerms as $term) {
            $products->where('product_name', 'LIKE', '%' . $term . '%');
        }

        foreach ($searchTerms as $term) {
            $products->orWhere('tags', 'LIKE', '%' . $term . '%');
        }

        $products = $products->select('id', 'product_name', 'product_id')->get();

        return response()->json($products);
    }





}

