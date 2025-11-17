<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Products;
use App\Models\AffiliateCartItem;
use App\Models\ShippingCharge;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Exception;

class CartController extends Controller
{
    /**
     * Add product to cart with material variation support
     */
    public function addToCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,product_id',
            'size' => 'nullable|string',
            'color' => 'nullable|string',
            'material' => 'nullable|string',
            'quantity' => 'nullable|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            Log::info('API Add to Cart request:', $request->all());

            $productId = $request->input('product_id');
            $size = $request->input('size');
            $color = $request->input('color');
            $material = $request->input('material');
            $quantity = $request->input('quantity', 1);
            $userId = Auth::id();

            $product = Products::with('variations')->where('product_id', $productId)->first();

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found'
                ], 404);
            }

            // Check stock
            $sizeVar = $size ? $product->variations()->where('type', 'Size')->where('value', $size)->first() : null;
            $colorVar = $color ? $product->variations()->where('type', 'Color')->where('value', $color)->first() : null;
            $materialVar = $material ? $product->variations()->where('type', 'Material')->where('value', $material)->first() : null;

            if (($sizeVar && $sizeVar->quantity < $quantity) ||
                ($colorVar && $colorVar->quantity < $quantity) ||
                ($materialVar && $materialVar->quantity < $quantity) ||
                (!$sizeVar && !$colorVar && !$materialVar && $product->quantity < $quantity)
            ) {
                return response()->json([
                    'success' => false,
                    'message' => 'Requested quantity not available'
                ], 422);
            }

            $item = CartItem::where('user_id', $userId)
                ->where('product_id', $productId)
                ->where('size', $size)
                ->where('color', $color)
                ->where('material', $material)
                ->first();

            if ($item) {
                $item->quantity += $quantity;
                $item->save();
                $message = 'Cart item quantity updated';
            } else {
                CartItem::create([
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'size' => $size,
                    'color' => $color,
                    'material' => $material
                ]);
                $message = 'Product added to cart';
            }

            $cartCount = CartItem::where('user_id', $userId)->sum('quantity');

            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => [
                    'cart_count' => $cartCount
                ]
            ]);

        } catch (Exception $e) {
            Log::error('Error adding to cart:', ['error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to add product to cart',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Add product to affiliate cart
     */
    public function addToCartAffiliate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,product_id',
            'quantity' => 'nullable|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $productId = $request->input('product_id');
            $quantity = $request->input('quantity', 1);
            $userId = Auth::id();

            $product = Products::where('product_id', $productId)->first();

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found'
                ], 404);
            }

            $affiliatePrice = $product->affiliate_price ?? $product->total_price;

            $item = AffiliateCartItem::where('user_id', $userId)
                ->where('product_id', $productId)
                ->where('is_affiliate', true)
                ->first();

            if ($item) {
                $item->quantity += $quantity;
                $item->save();
                $message = 'Affiliate cart item quantity updated';
            } else {
                AffiliateCartItem::create([
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'price' => $affiliatePrice,
                ]);
                $message = 'Product added to affiliate cart';
            }

            $cartCount = AffiliateCartItem::where('user_id', $userId)
                ->where('is_affiliate', true)
                ->sum('quantity');

            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => [
                    'cart_count' => $cartCount,
                    'affiliate_price' => $affiliatePrice
                ]
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add product to affiliate cart',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * ✅ FIXED: Get cart items with images like ProductController
     */
    public function getCart()
    {
        try {
            $userId = Auth::id();
            
            $cartItems = CartItem::with(['product' => function($query) {
                $query->with(['images', 'sale', 'specialOffer', 'variations']);
            }])->where('user_id', $userId)->get();

            $formattedCart = $cartItems->map(function($item) {
                $product = $item->product;
                if (!$product) return null;

                $currentPrice = $this->calculateItemPrice($product);

                // ✅ Format images like ProductController
                $imageUrls = $product->images->map(function($image) {
                    return asset('storage/' . $image->image_path);
                });

                return [
                    'cart_id' => $item->id,
                    'product_id' => $product->product_id,
                    'product_name' => $product->product_name,
                    'image_urls' => $imageUrls,  // ✅ ALL IMAGES
                    'product_image' => $imageUrls->first() ?? null,  // ✅ MAIN IMAGE
                    'normal_price' => $product->normal_price,
                    'sale_price' => $product->sale?->sale_price,
                    'offer_price' => $product->specialOffer?->offer_price,
                    'current_price' => $currentPrice,
                    'quantity' => $item->quantity,
                    'size' => $item->size,
                    'color' => $item->color,
                    'material' => $item->material,
                    'subtotal' => $currentPrice * $item->quantity
                ];
            })->filter();

            $subtotal = $formattedCart->sum('subtotal');
            $deliveryFee = $this->calculateTotalDeliveryFee($cartItems);

            Log::info('Cart calculation:', [
                'subtotal' => $subtotal,
                'delivery_fee' => $deliveryFee,
                'total' => $subtotal + $deliveryFee
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Cart retrieved successfully',
                'data' => [
                    'cart_items' => $formattedCart,
                    'total_items' => $formattedCart->count(),
                    'total_quantity' => $formattedCart->sum('quantity'),
                    'subtotal' => round($subtotal, 2),
                    'delivery_fee' => round($deliveryFee, 2),
                    'total_amount' => round($subtotal + $deliveryFee, 2)
                ]
            ]);

        } catch (Exception $e) {
            Log::error('Error getting cart:', ['error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve cart',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update cart item quantity
     */
    public function updateCartItem(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cart_id' => 'required|exists:cart_items,id',
            'quantity' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $cartId = $request->input('cart_id');
            $quantity = $request->input('quantity');
            $userId = Auth::id();

            $cartItem = CartItem::where('user_id', $userId)
                ->where('id', $cartId)
                ->first();

            if (!$cartItem) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cart item not found'
                ], 404);
            }

            $cartItem->quantity = $quantity;
            $cartItem->save();

            $cartCount = CartItem::where('user_id', $userId)->sum('quantity');

            return response()->json([
                'success' => true,
                'message' => 'Cart item updated successfully',
                'data' => [
                    'cart_count' => $cartCount
                ]
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update cart item',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove item from cart
     */
    public function removeFromCart($cartId)
    {
        try {
            $userId = Auth::id();
            
            $cartItem = CartItem::where('user_id', $userId)
                ->where('id', $cartId)
                ->first();

            if (!$cartItem) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cart item not found'
                ], 404);
            }

            $cartItem->delete();

            $cartCount = CartItem::where('user_id', $userId)->sum('quantity');

            return response()->json([
                'success' => true,
                'message' => 'Item removed from cart',
                'data' => [
                    'cart_count' => $cartCount
                ]
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to remove item from cart',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get cart count
     */
    public function getCartCount()
    {
        try {
            $cartCount = CartItem::where('user_id', Auth::id())->sum('quantity');

            return response()->json([
                'success' => true,
                'message' => 'Cart count retrieved successfully',
                'data' => [
                    'cart_count' => $cartCount
                ]
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to get cart count',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get cart subtotal
     */
    public function getCartSubtotal()
    {
        try {
            $userId = Auth::id();
            $subtotal = 0;

            $cartItems = CartItem::with(['product.sale', 'product.specialOffer'])
                ->where('user_id', $userId)
                ->get();

            foreach ($cartItems as $item) {
                $product = $item->product;
                if (!$product) continue;

                $price = $this->calculateItemPrice($product);
                $subtotal += $price * $item->quantity;
            }

            return response()->json([
                'success' => true,
                'message' => 'Cart subtotal retrieved successfully',
                'data' => [
                    'subtotal' => round($subtotal, 2)
                ]
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to get cart subtotal',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Clear entire cart
     */
    public function clearCart()
    {
        try {
            $userId = Auth::id();
            
            CartItem::where('user_id', $userId)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Cart cleared successfully',
                'data' => [
                    'cart_count' => 0
                ]
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to clear cart',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Calculate shipping method
     */
    public function calculateShipping(Request $request)
    {
        try {
            $items = $request->input('items', []);
            $subtotal = 0;
            $itemTotals = [];

            Log::info('API Cart calculation request', ['items' => $items]);

            $userId = Auth::id();
            $cart = CartItem::with([
                'product.images',
                'product.specialOffer' => function ($query) {
                    $query->where('status', 'active');
                },
                'product.sale' => function ($query) {
                    $query->where('status', 'active');
                }
            ])->where('user_id', $userId)->get();

            foreach ($items as $requestItem) {
                $productId = $requestItem['product_id'];
                $newQuantity = $requestItem['quantity'];

                $cartItem = $cart->first(function ($item) use ($productId) {
                    return $item->product_id === $productId;
                });

                if ($cartItem && isset($cartItem->product)) {
                    $price = $this->calculateItemPrice($cartItem->product);
                    $itemTotal = $price * $newQuantity;
                    $itemTotals[$productId] = $itemTotal;
                    $subtotal += $itemTotal;
                }
            }

            $deliveryFee = $this->calculateTotalDeliveryFee($cart);

            return response()->json([
                'success' => true,
                'delivery_fee' => number_format($deliveryFee, 2),
                'subtotal' => number_format($subtotal, 2),
                'total' => number_format($subtotal + $deliveryFee, 2),
                'item_totals' => array_map(function ($total) {
                    return number_format($total, 2);
                }, $itemTotals)
            ]);
            
        } catch (Exception $e) {
            Log::error('Error calculating cart shipping', [
                'error' => $e->getMessage(),
                'items' => $request->input('items', [])
            ]);

            return response()->json([
                'success' => false,
                'error' => 'Failed to calculate shipping'
            ], 500);
        }
    }

    /**
     * ✅ Centralized method to calculate item price with consistent logic
     */
    private function calculateItemPrice($product)
    {
        if ($product->specialOffer && $product->specialOffer->status === 'active') {
            return $product->specialOffer->offer_price;
        }

        if ($product->sale && $product->sale->status === 'active') {
            return $product->sale->sale_price;
        }

        return $product->normal_price;
    }

    /**
     * ✅ Calculate total delivery fee for cart
     */
    private function calculateTotalDeliveryFee($cart)
    {
        $totalDeliveryFee = 0;

        foreach ($cart as $item) {
            $productId = $item->product_id;
            $quantity = $item->quantity;

            Log::info("Checking shipping for product: $productId, qty: $quantity");

            $shippingCharge = ShippingCharge::where('product_id', $productId)
                ->where('min_quantity', '<=', $quantity)
                ->where('max_quantity', '>=', $quantity)
                ->first();

            if ($shippingCharge) {
                $productDeliveryFee = $shippingCharge->charge;
                $totalDeliveryFee += $productDeliveryFee;
                
                Log::info("Found shipping charge: Rs {$productDeliveryFee} for product {$productId}");
            } else {
                Log::warning("No matching shipping charge found for Product ID: {$productId}, Quantity: {$quantity}");
            }
        }

        Log::info("Total delivery fee calculated: Rs {$totalDeliveryFee}");

        return $totalDeliveryFee;
    }
}
