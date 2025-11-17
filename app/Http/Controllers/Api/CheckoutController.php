<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\CartItem;
use App\Models\ShippingCharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

class CheckoutController extends Controller
{
    /**
     * ✅ Get checkout data for cart items
     */
    public function getCartCheckout()
    {
        try {
            $userId = Auth::id();
            
            $cart = CartItem::where('user_id', $userId)
                ->with(['product' => function($query) {
                    $query->with(['images', 'sale', 'specialOffer', 'variations']);
                }])
                ->get();
            
            if ($cart->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Your cart is empty'
                ], 400);
            }

            $cartItems = [];
            $hasStockIssue = false;
            $stockIssues = [];
            $totalSavings = 0;

            foreach ($cart as $item) {
                $product = $item->product;
                
                if (!$product) continue;

                $stockCheck = $this->validateProductStock(
                    $product, 
                    $item->quantity, 
                    $item->size, 
                    $item->color, 
                    $item->material
                );
                
                if (!$stockCheck['available']) {
                    $hasStockIssue = true;
                    $stockIssues[] = [
                        'product_name' => $product->product_name,
                        'message' => $stockCheck['message']
                    ];
                    continue;
                }

                $pricingDetails = $this->calculateDetailedPricing($product);
                $itemTotal = $pricingDetails['selling_price'] * $item->quantity;
                $itemSavings = ($pricingDetails['original_price'] - $pricingDetails['selling_price']) * $item->quantity;
                $totalSavings += $itemSavings;
                
                // ✅ FIXED: Get full image URL like WishlistController
                $imagePath = null;
                if ($product->images->isNotEmpty()) {
                    $imagePath = asset('storage/' . $product->images->first()->image_path);
                }
                
                $cartItems[] = [
                    'cart_id' => $item->id,
                    'product_id' => $item->product_id,
                    'product_name' => $product->product_name,
                    'image' => $imagePath,  // ✅ Returns full URL
                    'original_price' => round($pricingDetails['original_price'], 2),
                    'selling_price' => round($pricingDetails['selling_price'], 2),
                    'discount_type' => $pricingDetails['discount_type'],
                    'discount_percentage' => round($pricingDetails['discount_percentage'], 2),
                    'discount_amount' => round($pricingDetails['discount_amount'], 2),
                    'has_discount' => $pricingDetails['has_discount'],
                    'quantity' => $item->quantity,
                    'size' => $item->size,
                    'color' => $item->color,
                    'material' => $item->material,
                    'item_total' => round($itemTotal, 2),
                    'item_savings' => round($itemSavings, 2),
                    'stock_available' => true
                ];
            }

            if ($hasStockIssue && empty($cartItems)) {
                return response()->json([
                    'success' => false,
                    'message' => 'All items in your cart are out of stock',
                    'stock_issues' => $stockIssues
                ], 422);
            }

            $subtotal = collect($cartItems)->sum('item_total');
            
            $cacheKey = "cart_shipping_{$userId}";
            $shipping = Cache::get($cacheKey);
            
            if ($shipping === null) {
                Log::info('Shipping not in cache, calculating fresh');
                $shipping = $this->calculateCartShipping($cart);
                Cache::put($cacheKey, $shipping, 600);
            } else {
                Log::info('Using cached shipping value', ['shipping' => $shipping]);
            }
            
            $total = $subtotal + $shipping;

            Log::info('Checkout calculation', [
                'user_id' => $userId,
                'subtotal' => $subtotal,
                'shipping' => $shipping,
                'total' => $total,
                'from_cache' => Cache::has($cacheKey)
            ]);

            return response()->json([
                'success' => true,
                'data' => [
                    'items' => $cartItems,
                    'pricing_summary' => [
                        'subtotal' => round($subtotal, 2),
                        'total_savings' => round($totalSavings, 2),
                        'shipping' => round($shipping, 2),
                        'total' => round($total, 2),
                        'total_quantity' => collect($cartItems)->sum('quantity')
                    ]
                ],
                'stock_issues' => $hasStockIssue ? $stockIssues : null
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error getting cart checkout: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error fetching checkout data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * ✅ Get checkout data for buy now
     */
    public function getBuyNowCheckout(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'product_id' => 'required|exists:products,product_id',
                'size' => 'nullable|string',
                'color' => 'nullable|string',
                'material' => 'nullable|string',
                'quantity' => 'required|integer|min:1',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $product = Products::with('variations', 'sale', 'specialOffer', 'images')
                ->where('product_id', $request->product_id)
                ->first();

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found'
                ], 404);
            }

            $stockCheck = $this->validateProductStock(
                $product, 
                $request->quantity, 
                $request->size, 
                $request->color, 
                $request->material
            );

            if (!$stockCheck['available']) {
                return response()->json([
                    'success' => false,
                    'message' => $stockCheck['message']
                ], 422);
            }

            $pricingDetails = $this->calculateDetailedPricing($product);
            $quantity = $request->input('quantity', 1);
            
            $subtotal = $pricingDetails['selling_price'] * $quantity;
            $totalSavings = ($pricingDetails['original_price'] - $pricingDetails['selling_price']) * $quantity;
            
            $shipping = $this->calculateProductShipping($product->product_id, $quantity);
            $total = $subtotal + $shipping;

            Log::info('Buy Now Checkout', [
                'product_id' => $product->product_id,
                'quantity' => $quantity,
                'shipping' => $shipping,
                'subtotal' => $subtotal,
                'total' => $total
            ]);

            // ✅ FIXED: Get full image URL like WishlistController
            $imagePath = null;
            if ($product->images->isNotEmpty()) {
                $imagePath = asset('storage/' . $product->images->first()->image_path);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'product' => [
                        'product_id' => $product->product_id,
                        'product_name' => $product->product_name,
                        'image' => $imagePath,  // ✅ Returns full URL
                        'description' => $product->short_description ?? $product->long_description,
                        'quantity' => $quantity,
                        'size' => $request->size,
                        'color' => $request->color,
                        'material' => $request->material,
                        'stock_available' => true,
                        'available_quantity' => $stockCheck['available_quantity']
                    ],
                    'pricing' => [
                        'original_price' => round($pricingDetails['original_price'], 2),
                        'selling_price' => round($pricingDetails['selling_price'], 2),
                        'has_discount' => $pricingDetails['has_discount'],
                        'discount_type' => $pricingDetails['discount_type'],
                        'discount_percentage' => round($pricingDetails['discount_percentage'], 2),
                        'discount_amount' => round($pricingDetails['discount_amount'], 2),
                    ],
                    'order_summary' => [
                        'subtotal' => round($subtotal, 2),
                        'shipping' => round($shipping, 2),
                        'total_savings' => round($totalSavings, 2),
                        'total' => round($total, 2),
                        'quantity' => $quantity
                    ],
                    'discount_info' => $pricingDetails['has_discount'] ? [
                        'badge' => round($pricingDetails['discount_percentage']) . "% OFF",
                        'message' => $pricingDetails['discount_type'] === 'sale' 
                            ? "Sale Price Applied!" 
                            : "Special Offer Applied!",
                        'expiry' => $this->getDiscountExpiry($product)
                    ] : null
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error getting buy now checkout: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error fetching checkout data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function calculateCartShipping($cart)
    {
        $totalDeliveryFee = 0;

        foreach ($cart as $item) {
            $productId = $item->product_id;
            $quantity = $item->quantity;

            $shippingCharge = ShippingCharge::where('product_id', $productId)
                ->where('min_quantity', '<=', $quantity)
                ->where('max_quantity', '>=', $quantity)
                ->first();

            if ($shippingCharge) {
                $totalDeliveryFee += $shippingCharge->charge;
                
                Log::debug("Cart shipping for product", [
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'charge' => $shippingCharge->charge
                ]);
            } else {
                Log::warning("No shipping charge found", [
                    'product_id' => $productId,
                    'quantity' => $quantity
                ]);
            }
        }

        return $totalDeliveryFee;
    }

    private function calculateProductShipping($productId, $quantity)
    {
        $shippingCharge = ShippingCharge::where('product_id', $productId)
            ->where('min_quantity', '<=', $quantity)
            ->where('max_quantity', '>=', $quantity)
            ->first();

        if ($shippingCharge) {
            Log::info("Product shipping calculated", [
                'product_id' => $productId,
                'quantity' => $quantity,
                'charge' => $shippingCharge->charge
            ]);
            
            return $shippingCharge->charge;
        }

        Log::warning("No shipping charge for product", [
            'product_id' => $productId,
            'quantity' => $quantity
        ]);

        return 0;
    }

    public function calculateShipping(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'product_id' => 'nullable|exists:products,product_id',
                'quantity' => 'required|integer|min:1',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $quantity = $request->input('quantity');
            $productId = $request->input('product_id');

            if ($productId) {
                $shipping = $this->calculateProductShipping($productId, $quantity);
            } else {
                $shipping = 0;
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'shipping_cost' => $shipping,
                    'quantity' => $quantity,
                    'product_id' => $productId
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error calculating shipping: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error calculating shipping cost'
            ], 500);
        }
    }

    public function getShippingOptions()
    {
        try {
            $shippingCharges = ShippingCharge::orderBy('product_id')
                ->orderBy('min_quantity')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $shippingCharges->map(function ($charge) {
                    return [
                        'id' => $charge->id,
                        'product_id' => $charge->product_id,
                        'min_quantity' => $charge->min_quantity,
                        'max_quantity' => $charge->max_quantity,
                        'charge' => $charge->charge,
                        'description' => $charge->product_id 
                            ? "Product {$charge->product_id}: {$charge->min_quantity}-{$charge->max_quantity} items = Rs {$charge->charge}"
                            : "{$charge->min_quantity}-{$charge->max_quantity} items = Rs {$charge->charge}"
                    ];
                })
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error getting shipping options: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error fetching shipping options'
            ], 500);
        }
    }

    // ========================================
    // HELPER METHODS
    // ========================================

    private function calculateDetailedPricing($product)
    {
        $originalPrice = $product->normal_price;
        $sellingPrice = $originalPrice;
        $discountType = null;
        $discountPercentage = 0;
        $hasDiscount = false;

        if ($product->sale && $product->sale->status === 'active') {
            $sellingPrice = $product->sale->sale_price;
            $discountType = 'sale';
            $hasDiscount = true;
        } elseif ($product->specialOffer && $product->specialOffer->status === 'active') {
            $sellingPrice = $product->specialOffer->offer_price;
            $discountType = 'special_offer';
            $hasDiscount = true;
        }

        if ($hasDiscount && $originalPrice > 0) {
            $discountAmount = $originalPrice - $sellingPrice;
            $discountPercentage = ($discountAmount / $originalPrice) * 100;
        } else {
            $discountAmount = 0;
        }

        return [
            'original_price' => $originalPrice,
            'selling_price' => $sellingPrice,
            'has_discount' => $hasDiscount,
            'discount_type' => $discountType,
            'discount_percentage' => $discountPercentage,
            'discount_amount' => $discountAmount,
        ];
    }

    private function getDiscountExpiry($product)
    {
        if ($product->sale && $product->sale->status === 'active' && $product->sale->end_date) {
            return "Sale ends on " . date('d M Y', strtotime($product->sale->end_date));
        }
        
        if ($product->specialOffer && $product->specialOffer->status === 'active' && $product->specialOffer->end_date) {
            return "Offer ends on " . date('d M Y', strtotime($product->specialOffer->end_date));
        }

        return null;
    }

    private function validateProductStock($product, $quantity, $size = null, $color = null, $material = null)
    {
        $sizeVar = $size ? $product->variations()->where('type', 'Size')->where('value', $size)->first() : null;
        $colorVar = $color ? $product->variations()->where('type', 'Color')->where('value', $color)->first() : null;
        $materialVar = $material ? $product->variations()->where('type', 'Material')->where('value', $material)->first() : null;

        if ($sizeVar && $sizeVar->quantity < $quantity) {
            return ['available' => false, 'message' => "Size '{$size}' out of stock", 'available_quantity' => $sizeVar->quantity];
        }

        if ($colorVar && $colorVar->quantity < $quantity) {
            return ['available' => false, 'message' => "Color '{$color}' out of stock", 'available_quantity' => $colorVar->quantity];
        }

        if ($materialVar && $materialVar->quantity < $quantity) {
            return ['available' => false, 'message' => "Material '{$material}' out of stock", 'available_quantity' => $materialVar->quantity];
        }

        if (!$sizeVar && !$colorVar && !$materialVar && $product->quantity < $quantity) {
            return ['available' => false, 'message' => 'Product out of stock', 'available_quantity' => $product->quantity];
        }

        $availableQuantity = $product->quantity;
        if ($sizeVar) $availableQuantity = min($availableQuantity, $sizeVar->quantity);
        if ($colorVar) $availableQuantity = min($availableQuantity, $colorVar->quantity);
        if ($materialVar) $availableQuantity = min($availableQuantity, $materialVar->quantity);

        return ['available' => true, 'message' => 'Stock available', 'available_quantity' => $availableQuantity];
    }
}
