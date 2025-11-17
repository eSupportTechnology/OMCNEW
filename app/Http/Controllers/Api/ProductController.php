<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Products;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\SpecialOffers;
use App\Models\Review;
use App\Models\Sale;
use App\Models\ShippingCharge;
use App\Models\Variation;
use App\Models\SubSubcategory;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * ✅ Get products by category with pagination
     */
    public function getProductsByCategory(Request $request, $category = null, $subcategory = null, $subsubcategory = null)
    {
        try {
            $perPage = $request->get('per_page', 16);
            $query = Products::with('images', 'specialOffer', 'sale', 'variations');

            if ($subsubcategory) {
                $query->where('sub_subcategory', $subsubcategory);
            } elseif ($subcategory) {
                $query->where('subcategory', $subcategory);
            } elseif ($category) {
                $query->where('product_category', $category);
            }

            $products = $query->paginate($perPage);
            
            $products->getCollection()->transform(function ($product) {
                return $this->formatProduct($product);
            });

            $colors = Variation::where('type', 'Color')->distinct()->get(['value', 'hex_value']);

            return response()->json([
                'success' => true,
                'data' => [
                    'products' => $products,
                    'colors' => $colors,
                    'category' => $category,
                    'subcategory' => $subcategory,
                    'subsubcategory' => $subsubcategory
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error fetching products by category: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch products'
            ], 500);
        }
    }

    /**
     * ✅ UPDATED: Get all products with advanced filters (matches web app)
     */
    public function getAllProducts(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 15);
            $categories = Category::all();

            // Base query with relationships
            $query = Products::with(['images', 'specialOffer', 'sale', 'variations'])
                ->withAvg(['reviews' => function ($q) {
                    $q->where('status', 'published');
                }], 'rating')
                ->withCount(['reviews as rating_count' => function ($q) {
                    $q->where('status', 'published');
                }]);

            // ✅ Apply category filter
            if ($request->filled('category')) {
                $query->where('product_category', $request->input('category'));
            }

            // ✅ Apply subcategory filter
            if ($request->filled('subcategory')) {
                $query->where('subcategory', $request->input('subcategory'));
            }

            // ✅ Apply subsubcategory filter
            if ($request->filled('subsubcategory')) {
                $query->where('sub_subcategory', $request->input('subsubcategory'));
            }

            // ✅ Apply color filter
            if ($request->filled('color')) {
                $color = $request->input('color');
                $query->whereHas('variations', function ($q) use ($color) {
                    $q->where('type', 'Color')->where('value', $color)->where('quantity', '>', 0);
                });
            }

            // ✅ Apply size filter
            if ($request->filled('size')) {
                $size = $request->input('size');
                $query->whereHas('variations', function ($q) use ($size) {
                    $q->where('type', 'Size')->where('value', $size)->where('quantity', '>', 0);
                });
            }

            // ✅ Apply material filter
            if ($request->filled('material')) {
                $material = $request->input('material');
                $query->whereHas('variations', function ($q) use ($material) {
                    $q->where('type', 'Material')->where('value', $material)->where('quantity', '>', 0);
                });
            }

            // ✅ Apply price range filter (includes sale/offer prices)
            if ($request->filled('min_price') && $request->filled('max_price')) {
                $minPrice = $request->input('min_price');
                $maxPrice = $request->input('max_price');

                $query->where(function ($q) use ($minPrice, $maxPrice) {
                    $q->where(function ($subQ) use ($minPrice, $maxPrice) {
                        $subQ->whereBetween('normal_price', [$minPrice, $maxPrice])
                            ->whereDoesntHave('sale', fn($sq) => $sq->where('status', 'active'))
                            ->whereDoesntHave('specialOffer', fn($sq) => $sq->where('status', 'active'));
                    })
                    ->orWhere(function ($subQ) use ($minPrice, $maxPrice) {
                        $subQ->whereHas('sale', fn($sq) => $sq->where('status', 'active')->whereBetween('sale_price', [$minPrice, $maxPrice]));
                    })
                    ->orWhere(function ($subQ) use ($minPrice, $maxPrice) {
                        $subQ->whereHas('specialOffer', fn($sq) => $sq->where('status', 'active')->whereBetween('offer_price', [$minPrice, $maxPrice]));
                    });
                });
            }

            // ✅ Apply sorting (matches web app)
            $sort = $request->input('sort', 'newest');

            switch ($sort) {
                case 'price_low_high':
                    $query->leftJoin('sales', function ($join) {
                        $join->on('products.product_id', '=', 'sales.product_id')
                            ->where('sales.status', 'active');
                    })
                    ->leftJoin('special_offers', function ($join) {
                        $join->on('products.product_id', '=', 'special_offers.product_id')
                            ->where('special_offers.status', 'active');
                    })
                    ->orderByRaw('
                        CASE
                            WHEN sales.status = "active" THEN sales.sale_price
                            WHEN special_offers.status = "active" THEN special_offers.offer_price
                            ELSE products.normal_price
                        END ASC
                    ')
                    ->select('products.*');
                    break;

                case 'price_high_low':
                    $query->leftJoin('sales', function ($join) {
                        $join->on('products.product_id', '=', 'sales.product_id')
                            ->where('sales.status', 'active');
                    })
                    ->leftJoin('special_offers', function ($join) {
                        $join->on('products.product_id', '=', 'special_offers.product_id')
                            ->where('special_offers.status', 'active');
                    })
                    ->orderByRaw('
                        CASE
                            WHEN sales.status = "active" THEN sales.sale_price
                            WHEN special_offers.status = "active" THEN special_offers.offer_price
                            ELSE products.normal_price
                        END DESC
                    ')
                    ->select('products.*');
                    break;

                case 'name_a_z':
                    $query->orderBy('product_name', 'asc');
                    break;

                case 'name_z_a':
                    $query->orderBy('product_name', 'desc');
                    break;

                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;

                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;

                case 'rating_high_low':
                    $query->orderByDesc('reviews_avg_rating');
                    break;

                default:
                    $query->orderBy('created_at', 'desc');
                    break;
            }

            // Paginate results
            $products = $query->paginate($perPage)->appends($request->query());
            
            $products->getCollection()->transform(function ($product) {
                return $this->formatProduct($product);
            });

            // Get available filter options
            $sizes = $this->getAvailableSizes($request);
            $colors = $this->getAvailableColors($request);
            $materials = $this->getAvailableMaterials($request);
            $priceRange = $this->getPriceRange($request);
            $activeFilters = $this->getActiveFilters($request);

            return response()->json([
                'success' => true,
                'data' => [
                    'products' => $products,
                    'categories' => $categories,
                    'sizes' => $sizes,
                    'colors' => $colors,
                    'materials' => $materials,
                    'price_range' => $priceRange,
                    'active_filters' => $activeFilters
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error fetching all products: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch products'
            ], 500);
        }
    }

    /**
     * ✅ UPDATED: Filter products with advanced options
     */
    public function filterProducts(Request $request)
    {
        try {
            $query = Products::with(['images', 'specialOffer', 'sale', 'variations']);

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
                    $q->whereIn('value', $request->selectedSizes)->where('type', 'Size');
                });
            }

            if (!empty($request->selectedColors)) {
                $query->whereHas('variations', function ($q) use ($request) {
                    $q->whereIn('hex_value', $request->selectedColors)
                      ->where('type', 'Color');
                });
            }

            if (!empty($request->selectedMaterials)) {
                $query->whereHas('variations', function ($q) use ($request) {
                    $q->whereIn('value', $request->selectedMaterials)
                      ->where('type', 'Material');
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
            
            $products->transform(function ($product) {
                return $this->formatProduct($product);
            });

            return response()->json([
                'success' => true,
                'data' => [
                    'products' => $products
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error filtering products: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to filter products'
            ], 500);
        }
    }

    /**
     * ✅ Get single product details
     */
    public function getProduct($product_id)
    {
        try {
            $product = Products::with(['images', 'variations', 'reviews.media', 'shippingCharges'])
                ->where('product_id', $product_id)
                ->firstOrFail();

            $specialOffer = SpecialOffers::where('product_id', $product_id)
                ->where('status', 'active')
                ->first();

            $sale = Sale::where('product_id', $product_id)
                ->where('status', 'active')
                ->first();

            $relatedProducts = Products::with('images')
                ->where('product_category', $product->product_category)
                ->where('product_id', '!=', $product->product_id)
                ->take(10)
                ->get();

            foreach ($relatedProducts as $relatedProduct) {
                $offer = SpecialOffers::where('product_id', $relatedProduct->product_id)
                    ->where('status', 'active')
                    ->first();

                $relatedProduct->offer_price = $offer ? $offer->offer_price : null;
                $relatedProduct->imageUrls = $relatedProduct->images->map(function($image) {
                    return asset('storage/' . $image->image_path);
                });
            }

            $reviews = Review::with('media')
                ->where('product_id', $product_id)
                ->where('status', 'published')
                ->get();

            $averageRating = $reviews->avg('rating') ?? 0;
            $totalReviews = $reviews->count();

            $ratingsCount = [
                '5' => Review::where('product_id', $product_id)->where('rating', 5)->where('status', 'published')->count(),
                '4' => Review::where('product_id', $product_id)->where('rating', 4)->where('status', 'published')->count(),
                '3' => Review::where('product_id', $product_id)->where('rating', 3)->where('status', 'published')->count(),
                '2' => Review::where('product_id', $product_id)->where('rating', 2)->where('status', 'published')->count(),
                '1' => Review::where('product_id', $product_id)->where('rating', 1)->where('status', 'published')->count(),
            ];

            // Add image URLs to main product
            $product->imageUrls = $product->images->map(function($image) {
                return asset('storage/' . $image->image_path);
            });

            // ✅ Format shipping charges
            $shippingCharges = $product->shippingCharges->map(function($charge) {
                return [
                    'min_quantity' => $charge->min_quantity,
                    'max_quantity' => $charge->max_quantity,
                    'charge' => $charge->charge,
                ];
            });

            return response()->json([
                'success' => true,
                'data' => [
                    'product' => $this->formatProduct($product),
                    'special_offer' => $specialOffer,
                    'sale' => $sale,
                    'related_products' => $relatedProducts,
                    'reviews' => $reviews,
                    'average_rating' => round($averageRating, 1),
                    'total_reviews' => $totalReviews,
                    'ratings_count' => $ratingsCount,
                    'shipping_charges' => $shippingCharges
                ]
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        } catch (\Exception $e) {
            Log::error('Error fetching product details: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch product details'
            ], 500);
        }
    }

    /**
     * ✅ Search products (improved)
     */
    public function searchProducts(Request $request)
    {
        try {
            $query = $request->get('query', '');
            $perPage = $request->get('per_page', 10);
            
            if (empty($query)) {
                return response()->json([
                    'success' => true,
                    'data' => [
                        'products' => [],
                        'query' => $query
                    ]
                ], 200);
            }

            $searchTerms = explode(' ', $query);

            $products = Products::with(['sale', 'specialOffer', 'images', 'category', 'category.subcategories', 'category.subcategories.subSubcategories'])
                ->where(function ($q) use ($searchTerms) {
                    foreach ($searchTerms as $term) {
                        $q->where(function ($subQ) use ($term) {
                            $subQ->where('product_name', 'LIKE', '%' . $term . '%')
                                ->orWhere('subcategory', 'LIKE', '%' . $term . '%')
                                ->orWhere('tags', 'LIKE', '%' . $term . '%');
                        })
                        ->orWhereHas('category', function ($categoryQuery) use ($term) {
                            $categoryQuery->where('parent_category', 'LIKE', '%' . $term . '%');
                        })
                        ->orWhereHas('category.subcategories', function ($subcategoryQuery) use ($term) {
                            $subcategoryQuery->where('subcategory', 'LIKE', '%' . $term . '%');
                        })
                        ->orWhereHas('category.subcategories.subSubcategories', function ($subSubcategoryQuery) use ($term) {
                            $subSubcategoryQuery->where('sub_subcategory', 'LIKE', '%' . $term . '%');
                        });
                    }
                })
                ->paginate($perPage);

            $products->getCollection()->transform(function ($product) {
                return $this->formatProduct($product);
            });

            return response()->json([
                'success' => true,
                'data' => [
                    'products' => $products,
                    'query' => $query
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error searching products: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Search failed'
            ], 500);
        }
    }

    /**
     * ✅ Get categories with subcategories
     */
    public function getCategories()
    {
        try {
            $categories = Category::with(['subcategories.subSubcategories'])->get();

            return response()->json([
                'success' => true,
                'data' => [
                    'categories' => $categories
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error fetching categories: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch categories'
            ], 500);
        }
    }

    /**
     * ✅ Get subcategories by category ID
     */
    public function getSubcategories($categoryId)
    {
        try {
            $subcategories = Subcategory::where('category_id', $categoryId)
                ->get(['id', 'subcategory as name']);

            return response()->json([
                'success' => true,
                'data' => [
                    'subcategories' => $subcategories
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error fetching subcategories: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch subcategories'
            ], 500);
        }
    }

    /**
     * ✅ Get sub-subcategories by subcategory ID
     */
    public function getSubSubcategories($subcategoryId)
    {
        try {
            $subSubcategories = SubSubcategory::where('subcategory_id', $subcategoryId)
                ->get(['id', 'sub_subcategory as name']);

            return response()->json([
                'success' => true,
                'data' => [
                    'sub_subcategories' => $subSubcategories
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error fetching sub-subcategories: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch sub-subcategories'
            ], 500);
        }
    }

    /**
     * ✅ Get product variations (colors, sizes, materials)
     */
    public function getVariations()
    {
        try {
            $colors = Variation::where('type', 'Color')->distinct()->get(['value', 'hex_value']);
            $sizes = Variation::where('type', 'Size')->distinct()->get(['value']);
            $materials = Variation::where('type', 'Material')->distinct()->get(['value']);

            return response()->json([
                'success' => true,
                'data' => [
                    'colors' => $colors,
                    'sizes' => $sizes,
                    'materials' => $materials
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error fetching variations: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch variations'
            ], 500);
        }
    }

    // ============================================
    // PRIVATE HELPER METHODS
    // ============================================

    /**
     * ✅ Format product with all necessary data
     */
    private function formatProduct($product)
    {
        $product->average_rating = $product->reviews()->where('status', 'published')->avg('rating') ?? 0;
        $product->rating_count = $product->reviews()->where('status', 'published')->count();
        
        $product->imageUrls = $product->images->map(function($image) {
            return asset('storage/' . $image->image_path);
        });

        // Add main image for compatibility
        $product->image = $product->imageUrls->first() ?? null;
        
        return $product;
    }

    /**
     * ✅ Get available sizes based on current filters
     */
    private function getAvailableSizes(Request $request)
    {
        $query = Products::query();

        if ($request->has('category') && !empty($request->input('category'))) {
            $query->where('product_category', $request->input('category'));
        }

        if ($request->has('color') && !empty($request->input('color'))) {
            $query->whereHas('variations', function ($q) use ($request) {
                $q->where('type', 'Color')->where('value', $request->input('color'));
            });
        }

        if ($request->has('material') && !empty($request->input('material'))) {
            $query->whereHas('variations', function ($q) use ($request) {
                $q->where('type', 'Material')->where('value', $request->input('material'));
            });
        }

        return Variation::where('type', 'Size')
            ->where('quantity', '>', 0)
            ->whereHas('product', function ($q) use ($query) {
                $q->whereIn('product_id', $query->pluck('product_id'));
            })
            ->distinct()
            ->get(['value']);
    }

    /**
     * ✅ Get available colors based on current filters
     */
    private function getAvailableColors(Request $request)
    {
        $query = Products::query();

        if ($request->has('category') && !empty($request->input('category'))) {
            $query->where('product_category', $request->input('category'));
        }

        if ($request->has('size') && !empty($request->input('size'))) {
            $query->whereHas('variations', function ($q) use ($request) {
                $q->where('type', 'Size')->where('value', $request->input('size'));
            });
        }

        if ($request->has('material') && !empty($request->input('material'))) {
            $query->whereHas('variations', function ($q) use ($request) {
                $q->where('type', 'Material')->where('value', $request->input('material'));
            });
        }

        return Variation::where('type', 'Color')
            ->where('quantity', '>', 0)
            ->whereHas('product', function ($q) use ($query) {
                $q->whereIn('product_id', $query->pluck('product_id'));
            })
            ->distinct()
            ->get(['value', 'hex_value']);
    }

    /**
     * ✅ NEW: Get available materials based on current filters
     */
    private function getAvailableMaterials(Request $request)
    {
        $query = Products::query();

        if ($request->has('category') && !empty($request->input('category'))) {
            $query->where('product_category', $request->input('category'));
        }

        if ($request->has('size') && !empty($request->input('size'))) {
            $query->whereHas('variations', function ($q) use ($request) {
                $q->where('type', 'Size')->where('value', $request->input('size'));
            });
        }

        if ($request->has('color') && !empty($request->input('color'))) {
            $query->whereHas('variations', function ($q) use ($request) {
                $q->where('type', 'Color')->where('value', $request->input('color'));
            });
        }

        return Variation::where('type', 'Material')
            ->where('quantity', '>', 0)
            ->whereHas('product', function ($q) use ($query) {
                $q->whereIn('product_id', $query->pluck('product_id'));
            })
            ->distinct()
            ->get(['value']);
    }

    /**
     * ✅ Get price range based on current filters
     */
    private function getPriceRange(Request $request)
    {
        $query = Products::with(['sale' => function ($q) {
            $q->where('status', 'active');
        }, 'specialOffer' => function ($q) {
            $q->where('status', 'active');
        }]);

        if ($request->has('category') && !empty($request->input('category'))) {
            $query->where('product_category', $request->input('category'));
        }

        if ($request->has('color') && !empty($request->input('color'))) {
            $query->whereHas('variations', function ($q) use ($request) {
                $q->where('type', 'Color')->where('value', $request->input('color'));
            });
        }

        if ($request->has('size') && !empty($request->input('size'))) {
            $query->whereHas('variations', function ($q) use ($request) {
                $q->where('type', 'Size')->where('value', $request->input('size'));
            });
        }

        if ($request->has('material') && !empty($request->input('material'))) {
            $query->whereHas('variations', function ($q) use ($request) {
                $q->where('type', 'Material')->where('value', $request->input('material'));
            });
        }

        $products = $query->get();
        $prices = [];

        foreach ($products as $product) {
            if ($product->sale && $product->sale->status === 'active') {
                $prices[] = $product->sale->sale_price;
            } elseif ($product->specialOffer && $product->specialOffer->status === 'active') {
                $prices[] = $product->specialOffer->offer_price;
            } else {
                $prices[] = $product->normal_price;
            }
        }

        return [
            'min' => !empty($prices) ? min($prices) : 0,
            'max' => !empty($prices) ? max($prices) : 10000
        ];
    }

    /**
     * ✅ Get active filters
     */
    private function getActiveFilters(Request $request)
    {
        $filters = [];

        if ($request->has('category') && !empty($request->input('category'))) {
            $filters['category'] = $request->input('category');
        }

        if ($request->has('color') && !empty($request->input('color'))) {
            $filters['color'] = $request->input('color');
        }

        if ($request->has('size') && !empty($request->input('size'))) {
            $filters['size'] = $request->input('size');
        }

        if ($request->has('material') && !empty($request->input('material'))) {
            $filters['material'] = $request->input('material');
        }

        if ($request->has('min_price') && $request->has('max_price')) {
            $minPrice = $request->input('min_price');
            $maxPrice = $request->input('max_price');
            if (!empty($minPrice) && !empty($maxPrice)) {
                $filters['price'] = "Rs. {$minPrice} - Rs. {$maxPrice}";
            }
        }

        return $filters;
    }
}
