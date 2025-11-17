<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WishlistController extends Controller
{
    /**
     * ✅ FIXED: Get user's wishlist items with proper images
     */
    public function getWishlist()
    {
        try {
            $userId = Auth::id();
            
            $wishlistItems = Wishlist::where('user_id', $userId)
                ->with(['product' => function($query) {
                    $query->with(['images', 'sale', 'specialOffer']);
                }])
                ->get();

            $formattedItems = $wishlistItems->map(function($item) {
                $product = $item->product;
                if (!$product) return null;

                // ✅ Format images like ProductController
                $imageUrls = $product->images->map(function($image) {
                    return asset('storage/' . $image->image_path);
                });

                // Calculate current price with proper logic
                $currentPrice = $product->normal_price;
                if ($product->specialOffer && $product->specialOffer->status === 'active') {
                    $currentPrice = $product->specialOffer->offer_price;
                } elseif ($product->sale && $product->sale->status === 'active') {
                    $currentPrice = $product->sale->sale_price;
                }

                return [
                    'wishlist_id' => $item->id,
                    'product_id' => $product->product_id,
                    'product_name' => $product->product_name,
                    'image_urls' => $imageUrls,  // ✅ ALL IMAGES
                    'product_image' => $imageUrls->first() ?? null,  // ✅ MAIN IMAGE
                    'normal_price' => (float) $product->normal_price,
                    'sale_price' => $product->sale && $product->sale->status === 'active' 
                        ? (float) $product->sale->sale_price 
                        : null,
                    'offer_price' => $product->specialOffer && $product->specialOffer->status === 'active' 
                        ? (float) $product->specialOffer->offer_price 
                        : null,
                    'current_price' => (float) $currentPrice,
                    'discount_percentage' => $this->calculateDiscountPercentage(
                        $product->normal_price, 
                        $currentPrice
                    ),
                    'in_stock' => $product->quantity > 0,
                    'quantity' => $product->quantity,
                    'added_at' => $item->created_at->format('Y-m-d H:i:s')
                ];
            })->filter();

            return response()->json([
                'success' => true,
                'message' => 'Wishlist retrieved successfully',
                'data' => [
                    'wishlist_items' => $formattedItems->values(),
                    'total_items' => $formattedItems->count()
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve wishlist',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Add/Remove product from wishlist
     */
    public function toggleWishlist(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,product_id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $userId = Auth::id();
            $productId = $request->input('product_id');
            
            $wishlistItem = Wishlist::where('user_id', $userId)
                                  ->where('product_id', $productId)
                                  ->first();
            
            if ($wishlistItem) {
                $wishlistItem->delete();
                $message = 'Product removed from wishlist';
                $action = 'removed';
                $isFavorite = false;
            } else {
                Wishlist::create([
                    'user_id' => $userId, 
                    'product_id' => $productId
                ]);
                $message = 'Product added to wishlist';
                $action = 'added';
                $isFavorite = true;
            }

            $wishlistCount = Wishlist::where('user_id', $userId)->count();

            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => [
                    'action' => $action,
                    'is_favorite' => $isFavorite,
                    'wishlist_count' => $wishlistCount
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update wishlist',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Check multiple products in wishlist
     */
    public function checkMultipleWishlist(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,product_id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $productIds = $request->input('product_ids');
            $userId = Auth::id();

            $wishlistProducts = Wishlist::where('user_id', $userId)
                                      ->whereIn('product_id', $productIds)
                                      ->pluck('product_id')
                                      ->toArray();

            return response()->json([
                'success' => true,
                'message' => 'Wishlist status retrieved successfully',
                'data' => [
                    'wishlist_product_ids' => $wishlistProducts
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to check wishlist status',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove item from wishlist
     */
    public function removeFromWishlist($id)
    {
        try {
            $wishlistItem = Wishlist::where('user_id', Auth::id())
                                  ->where('id', $id)
                                  ->first();

            if (!$wishlistItem) {
                return response()->json([
                    'success' => false,
                    'message' => 'Wishlist item not found'
                ], 404);
            }

            $productId = $wishlistItem->product_id;
            $wishlistItem->delete();

            $wishlistCount = Wishlist::where('user_id', Auth::id())->count();

            return response()->json([
                'success' => true,
                'message' => 'Item removed from wishlist',
                'data' => [
                    'product_id' => $productId,
                    'wishlist_count' => $wishlistCount
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to remove item from wishlist',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get wishlist count
     */
    public function getWishlistCount()
    {
        try {
            $wishlistCount = Wishlist::where('user_id', Auth::id())->count();

            return response()->json([
                'success' => true,
                'message' => 'Wishlist count retrieved successfully',
                'data' => [
                    'wishlist_count' => $wishlistCount
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to get wishlist count',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Calculate discount percentage
     */
    private function calculateDiscountPercentage($normalPrice, $currentPrice)
    {
        if ($normalPrice <= 0 || $currentPrice >= $normalPrice) {
            return 0;
        }
        
        return round((($normalPrice - $currentPrice) / $normalPrice) * 100);
    }
}
