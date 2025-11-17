<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderItems;
use App\Models\Inquiry;
use App\Models\Review;
use App\Models\ReviewMedia;
use App\Models\Products;
use App\Models\Address;
use App\Models\ShippingCharge;
use App\Models\Variation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class UserDashboardController extends Controller
{
    /**
     * Get dashboard overview data
     */
    public function getDashboardOverview()
    {
        try {
            $userId = Auth::id();
            
            $totalOrders = CustomerOrder::where('user_id', $userId)->count();
            $pendingOrders = CustomerOrder::where('user_id', $userId)->where('status', 'Confirmed')->count();
            $deliveredOrders = CustomerOrder::where('user_id', $userId)->where('status', 'Delivered')->count();
            $cancelledOrders = CustomerOrder::where('user_id', $userId)->where('status', 'Cancelled')->count();
            
            $recentActivities = $this->getRecentActivities($userId);
            $recentNotifications = $this->getRecentNotifications($userId);
            
            $totalSpent = CustomerOrder::where('user_id', $userId)
                ->whereIn('status', ['Delivered', 'Shipped'])
                ->sum('total_cost');

            return response()->json([
                'success' => true,
                'data' => [
                    'statistics' => [
                        'total_orders' => $totalOrders,
                        'pending_orders' => $pendingOrders,
                        'delivered_orders' => $deliveredOrders,
                        'cancelled_orders' => $cancelledOrders,
                        'total_spent' => round($totalSpent, 2),
                    ],
                    'recent_activities' => $recentActivities,
                    'recent_notifications' => $recentNotifications,
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error getting dashboard overview: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to get dashboard overview',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * ✅ UPDATED: Cancel order with stock restoration and material variation support
     */
    public function cancelOrder($orderCode)
    {
        try {
            $order = CustomerOrder::where('order_code', $orderCode)
                ->where('user_id', Auth::id())
                ->first();

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found'
                ], 404);
            }

            if ($order->status === 'Cancelled') {
                return response()->json([
                    'success' => false,
                    'message' => 'Order already cancelled'
                ], 400);
            }

            // ✅ Restore stock for cancelled items (with material support)
            $orderItems = CustomerOrderItems::where('order_code', $orderCode)->get();

            foreach ($orderItems as $item) {
                $product = Products::where('product_id', $item->product_id)->first();

                if ($product) {
                    // Restore main product quantity
                    $product->quantity += $item->quantity;
                    $product->save();

                    // Restore size variation quantity
                    if ($item->size) {
                        Variation::where('product_id', $item->product_id)
                            ->where('type', 'Size')
                            ->where('value', $item->size)
                            ->increment('quantity', $item->quantity);
                    }

                    // Restore color variation quantity
                    if ($item->color) {
                        Variation::where('product_id', $item->product_id)
                            ->where('type', 'Color')
                            ->where('value', $item->color)
                            ->increment('quantity', $item->quantity);
                    }

                    // ✅ NEW: Restore material variation quantity
                    if ($item->material) {
                        Variation::where('product_id', $item->product_id)
                            ->where('type', 'Material')
                            ->where('value', $item->material)
                            ->increment('quantity', $item->quantity);
                    }
                }
            }

            $order->status = 'Cancelled';
            $order->save();

            Log::info('Order cancelled', [
                'order_code' => $orderCode,
                'user_id' => Auth::id(),
                'items_restored' => $orderItems->count()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Order cancelled successfully',
                'data' => [
                    'order_code' => $order->order_code,
                    'status' => $order->status
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error cancelling order', [
                'error' => $e->getMessage(),
                'order_code' => $orderCode
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to cancel order',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Confirm delivery
     */
    public function confirmDelivery($orderCode)
    {
        try {
            $order = CustomerOrder::where('order_code', $orderCode)
                ->where('user_id', Auth::id())
                ->first();

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found'
                ], 404);
            }

            if (strtolower($order->status) !== 'shipped') {
                return response()->json([
                    'success' => false,
                    'message' => 'Order must be shipped before confirming delivery'
                ], 400);
            }

            $order->status = 'Delivered';
            $order->save();

            return response()->json([
                'success' => true,
                'message' => 'Delivery confirmed successfully',
                'data' => [
                    'order_code' => $order->order_code,
                    'status' => $order->status
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error confirming delivery: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to confirm delivery',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get user inquiries
     */
    public function getInquiries(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 10);
            
            $inquiries = Inquiry::where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->paginate($perPage);

            return response()->json([
                'success' => true,
                'data' => [
                    'data' => $inquiries->items(),
                    'current_page' => $inquiries->currentPage(),
                    'last_page' => $inquiries->lastPage(),
                    'per_page' => $inquiries->perPage(),
                    'total' => $inquiries->total(),
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error getting inquiries: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to get inquiries',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * ✅ UPDATED: Get user reviews with material variation support
     */
   /**
 * ✅ FIXED: Get user reviews with proper image URLs and material variation support
 */
public function getReviews(Request $request)
{
    try {
        $perPage = $request->get('per_page', 10);
        
        // Get items to be reviewed (with material)
        $toBeReviewedItems = CustomerOrderItems::with(['order', 'product.images', 'product.variations'])
            ->whereHas('order', function ($query) {
                $query->where('status', 'Delivered')
                      ->where('user_id', Auth::id());
            })
            ->where('reviewed', 'no')
            ->whereHas('product')
            ->paginate($perPage);

        // Get reviewed items with media
        $reviewedItems = Review::with(['product.images', 'media'])
            ->where('user_id', Auth::id())
            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => [
                'to_be_reviewed' => [
                    'data' => $toBeReviewedItems->map(function($item) {
                        // ✅ Get proper image URL
                        $imageUrl = null;
                        if ($item->product && $item->product->images->isNotEmpty()) {
                            $firstImage = $item->product->images->first();
                            $imageUrl = $firstImage->image_path;
                        }

                        return [
                            'order_code' => $item->order_code,
                            'product_id' => $item->product_id,
                            'product_name' => $item->product->product_name ?? 'Unknown',
                            'image' => $imageUrl,  // ✅ FIXED: Returns proper path
                            'quantity' => $item->quantity,
                            'cost' => $item->cost,
                            'size' => $item->size,
                            'color' => $item->color,
                            'material' => $item->material,
                            'order_date' => $item->order->created_at->format('M d, Y'),
                        ];
                    }),
                    'current_page' => $toBeReviewedItems->currentPage(),
                    'last_page' => $toBeReviewedItems->lastPage(),
                    'total' => $toBeReviewedItems->total(),
                ],
                'reviewed' => [
                    'data' => $reviewedItems->map(function($review) {
                        // ✅ Get proper image URL for reviewed items
                        $imageUrl = null;
                        if ($review->product && $review->product->images->isNotEmpty()) {
                            $firstImage = $review->product->images->first();
                            $imageUrl = $firstImage->image_path;
                        }

                        return [
                            'id' => $review->id,
                            'user_id' => $review->user_id,
                            'product_id' => $review->product_id,
                            'product_name' => $review->product->product_name ?? 'Unknown',
                            'image' => $imageUrl,  // ✅ FIXED: Returns proper path
                            'order_code' => $review->order_code,
                            'rating' => $review->rating,
                            'comment' => $review->comment,
                            'is_anonymous' => $review->is_anonymous,
                            'status' => $review->status,
                            'created_at' => $review->created_at->format('Y-m-d H:i:s'),
                            'updated_at' => $review->updated_at->format('Y-m-d H:i:s'),
                            'media' => $review->media->map(function($media) {
                                return [
                                    'id' => $media->id,
                                    'media_type' => $media->media_type,
                                    'media_path' => $media->media_path,
                                    'created_at' => $media->created_at->format('Y-m-d H:i:s'),
                                ];
                            }),
                        ];
                    }),
                    'current_page' => $reviewedItems->currentPage(),
                    'last_page' => $reviewedItems->lastPage(),
                    'total' => $reviewedItems->total(),
                ]
            ]
        ]);

    } catch (\Exception $e) {
        Log::error('Error getting reviews: ' . $e->getMessage());
        
        return response()->json([
            'success' => false,
            'message' => 'Failed to get reviews',
            'error' => $e->getMessage()
        ], 500);
    }
}

    /**
     * Store review
     */
    public function storeReview(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required',
                'order_code' => 'required|string',
                'rating' => 'required|integer|min:1|max:5',
                'comment' => 'nullable|string',
                'is_anonymous' => 'required|boolean',
                'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
                'video' => 'nullable|mimes:mp4,mov,ogg|max:50000',
            ]);

            $review = Review::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'order_code' => $request->order_code,
                'rating' => $request->rating,
                'comment' => $request->comment,
                'is_anonymous' => $request->is_anonymous,
            ]);

            CustomerOrderItems::where('order_code', $request->order_code)
                ->where('product_id', $request->product_id)
                ->update(['reviewed' => 'yes']);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imagePath = $image->store('reviews/images', 'public');
                    ReviewMedia::create([
                        'review_id' => $review->id,
                        'media_type' => 'image',
                        'media_path' => $imagePath,
                    ]);
                }
            }

            if ($request->hasFile('video')) {
                $videoPath = $request->file('video')->store('reviews/videos', 'public');
                ReviewMedia::create([
                    'review_id' => $review->id,
                    'media_type' => 'video',
                    'media_path' => $videoPath,
                ]);
            }

            $review->load(['product', 'media']);

            return response()->json([
                'success' => true,
                'message' => 'Review submitted successfully',
                'data' => $review
            ], 201);

        } catch (\Exception $e) {
            Log::error('Error storing review: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to submit review',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get user addresses
     */
    public function getAddresses()
    {
        try {
            $addresses = Address::where('user_id', Auth::id())
                ->orderBy('default', 'desc')
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $addresses
            ]);

        } catch (\Exception $e) {
            Log::error('Error getting addresses: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to get addresses',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store new address
     */
    public function storeAddress(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'first_name' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
                'email' => 'required|string|email|max:255',
                'address' => 'required|string|max:255',
                'apartment' => 'nullable|string|max:255',
                'city' => 'required|string|max:255',
                'postal_code' => 'required|string|max:10',
                'default' => 'nullable|boolean',
            ]);

            $user = Auth::user();

            if ($validatedData['default'] ?? false) {
                Address::where('user_id', $user->id)
                    ->update(['default' => false]);
            }

            $address = Address::create([
                'user_id' => $user->id,
                'full_name' => $validatedData['first_name'],
                'phone_num' => $validatedData['phone'],
                'email' => $validatedData['email'],
                'address' => $validatedData['address'],
                'apartment' => $validatedData['apartment'],
                'city' => $validatedData['city'],
                'postal_code' => $validatedData['postal_code'],
                'default' => $validatedData['default'] ?? false,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Address added successfully',
                'data' => $address
            ], 201);

        } catch (\Exception $e) {
            Log::error('Error storing address: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to add address',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update address
     */
    public function updateAddress(Request $request, $addressId)
    {
        try {
            $validatedData = $request->validate([
                'first_name' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
                'email' => 'required|string|email|max:255',
                'address' => 'required|string|max:255',
                'apartment' => 'nullable|string|max:255',
                'city' => 'required|string|max:255',
                'postal_code' => 'required|string|max:10',
                'default' => 'nullable|boolean',
            ]);

            $address = Address::where('id', $addressId)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            if ($validatedData['default'] ?? false) {
                Address::where('user_id', Auth::id())
                    ->where('id', '!=', $addressId)
                    ->update(['default' => false]);
            }

            $address->update([
                'full_name' => $validatedData['first_name'],
                'phone_num' => $validatedData['phone'],
                'email' => $validatedData['email'],
                'address' => $validatedData['address'],
                'apartment' => $validatedData['apartment'],
                'city' => $validatedData['city'],
                'postal_code' => $validatedData['postal_code'],
                'default' => $validatedData['default'] ?? false,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Address updated successfully',
                'data' => $address
            ]);

        } catch (\Exception $e) {
            Log::error('Error updating address: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to update address',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete address
     */
    public function deleteAddress($addressId)
    {
        try {
            $address = Address::where('id', $addressId)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            $address->delete();

            return response()->json([
                'success' => true,
                'message' => 'Address deleted successfully'
            ]);

        } catch (\Exception $e) {
            Log::error('Error deleting address: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete address',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get recent activities
     */
    private function getRecentActivities($userId)
    {
        $orderActivities = CustomerOrder::where('user_id', $userId)
            ->orderBy('updated_at', 'desc')
            ->limit(3)
            ->get(['order_code', 'created_at', 'status'])
            ->map(function ($order) {
                return [
                    'type' => 'order',
                    'message' => "Order #{$order->order_code} placed",
                    'date' => $order->created_at->format('M d, Y'),
                    'status' => $order->status,
                ];
            });

        $reviewActivities = Review::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get(['product_id', 'created_at', 'rating'])
            ->map(function ($review) {
                return [
                    'type' => 'review',
                    'message' => "Review submitted for product",
                    'date' => $review->created_at->format('M d, Y'),
                    'rating' => $review->rating,
                ];
            });

        $activities = $orderActivities->merge($reviewActivities);
        return $activities->sortByDesc('date')->take(3)->values();
    }

    /**
     * Get recent notifications
     */
    private function getRecentNotifications($userId)
    {
        $notifications = CustomerOrder::where('user_id', $userId)
            ->whereIn('status', ['Shipped', 'Delivered'])
            ->orderBy('updated_at', 'desc')
            ->limit(3)
            ->get(['order_code', 'updated_at', 'status'])
            ->map(function ($order) {
                return [
                    'message' => "Order #{$order->order_code} has been " . strtolower($order->status),
                    'date' => $order->updated_at->format('M d, Y'),
                    'type' => strtolower($order->status),
                ];
            });

        return $notifications->values();
    }
}
