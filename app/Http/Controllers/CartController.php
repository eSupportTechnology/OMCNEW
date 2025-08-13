<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Address;
use App\Models\Products;
use App\Models\AffiliateCartItem;
use App\Models\ShippingCharge;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{


    public function addToCart(Request $request)
    {
        Log::info('Cart add request data:', $request->all());

        $productId = $request->input('product_id');
        $size = $request->input('size');
        $color = $request->input('color');
        $quantity = $request->input('quantity', 1); // Add this line to get the quantity

        if (!$productId) {
            return response()->json(['error' => 'Product ID is missing.'], 400);
        }

        if (Auth::check()) {
            $user = Auth::user();
            $item = CartItem::where('user_id', $user->id)
                ->where('product_id', $productId)
                ->where('size', $size)
                ->where('color', $color)
                ->first();

            if ($item) {
                $item->quantity += $quantity; // Use the selected quantity
                $item->save();
            } else {
                CartItem::create([
                    'user_id' => $user->id,
                    'product_id' => $productId,
                    'quantity' => $quantity, // Use the selected quantity
                    'size' => $size,
                    'color' => $color
                ]);
            }
        } else {
            $cart = session()->get('cart', []);
            $itemFound = false;

            foreach ($cart as &$item) {
                if ($item['product_id'] === $productId && $item['size'] === $size && $item['color'] === $color) {
                    $item['quantity'] += $quantity; // Use the selected quantity
                    $itemFound = true;
                    break;
                }
            }

            if (!$itemFound) {
                $cart[] = [
                    'product_id' => $productId,
                    'quantity' => $quantity, // Use the selected quantity
                    'size' => $size,
                    'color' => $color
                ];
            }

            session()->put('cart', $cart);
        }

        $cartCount = Auth::check() ? CartItem::where('user_id', Auth::id())->sum('quantity') : array_sum(array_column(session()->get('cart', []), 'quantity'));
        return response()->json(['cart_count' => $cartCount]);
    }



    public function addToCartAffiliate(Request $request)
    {
        $productId = $request->input('product_id');

        if (!$productId) {
            return response()->json(['error' => 'Product ID is required.'], 400);
        }

        $product = Products::where('product_id', $productId)->first();


        if (!$product) {
            return response()->json(['error' => 'Product not found.'], 404);
        }

        $affiliatePrice = $product->affiliate_price ?? $product->total_price;

        if (Auth::check()) {
            $user = Auth::user();
            $item = AffiliateCartItem::where('user_id', $user->id)
                ->where('product_id', $productId)
                ->where('is_affiliate', true)
                ->first();

            if ($item) {
                $item->quantity += 1;
                $item->save();
            } else {
                AffiliateCartItem::create([
                    'user_id' => $user->id,
                    'product_id' => $productId,
                    'quantity' => 1,
                    'price' => $affiliatePrice,

                ]);
            }
        } else {
            $cart = session()->get('cart_affiliate', []);
            $itemFound = false;

            foreach ($cart as &$item) {
                if ($item['product_id'] === $productId) {
                    $item['quantity'] += 1;
                    $itemFound = true;
                    break;
                }
            }

            if (!$itemFound) {
                $cart[] = [
                    'product_id' => $productId,
                    'quantity' => 1,
                    'price' => $affiliatePrice
                ];
            }

            session()->put('cart_affiliate', $cart);
        }

        $cartCount = Auth::check()
            ? CartItem::where('user_id', Auth::id())->where('is_affiliate', true)->sum('quantity')
            : array_sum(array_column(session()->get('cart_affiliate', []), 'quantity'));

        return response()->json(['cart_count' => $cartCount]);
    }










    public function getCartCount()
    {
        if (Auth::check()) {
            $cartCount = CartItem::where('user_id', Auth::id())->count();
        } else {
            $cart = session()->get('cart', []);
            $cartCount = count($cart);
        }


        return response()->json(['cart_count' => $cartCount]);
    }

    public function getCartSubtotal()
    {
        $subtotal = 0;

        if (Auth::check()) {
            $cartItems = CartItem::with(['product.sale', 'product.specialOffer'])
                ->where('user_id', Auth::id())
                ->get();

            foreach ($cartItems as $item) {
                $product = $item->product;

                if (!$product) {
                    continue;
                }

                if ($product->sale) {
                    $price = $product->sale->sale_price;
                } elseif ($product->specialOffer) {
                    $price = $product->specialOffer->offer_price;
                } else {
                    $price = $product->normal_price;
                }

                $subtotal += $price * $item->quantity;
            }
        } else {
            $cart = session()->get('cart', []);

            foreach ($cart as $item) {
                $product = Products::with(['sale', 'specialOffer'])
                    ->where('product_id', $item['product_id'])
                    ->first();

                if (!$product) {
                    continue;
                }

                if ($product->sale) {
                    $price = $product->sale->sale_price;
                } elseif ($product->specialOffer) {
                    $price = $product->specialOffer->offer_price;
                } else {
                    $price = $product->normal_price;
                }

                $subtotal += $price * $item['quantity'];
            }
        }

        return response()->json(['subtotal' => round($subtotal, 2)]);
    }



    public function showCart()
    {
        if (Auth::check()) {
            $cart = CartItem::with([
                'product.images',
                'product.specialOffer' => function ($query) {
                    $query->where('status', 'active');
                },
                'product.sale' => function ($query) {
                    $query->where('status', 'active');
                }
            ])->where('user_id', Auth::id())->get();
        } else {
            $cart = session()->get('cart', []);
            $cart = collect($cart);
        }

        $deliveryFee = $this->calculateTotalDeliveryFee($cart);

        return view('frontend.cart', compact('cart', 'deliveryFee'));
    }

    public function calculateShipping(Request $request)
{
    try {
        $items = $request->input('items', []);
        $subtotal = 0;
        $totalDeliveryFee = 0;
        $itemTotals = [];

        Log::info('Cart calculation request', ['items' => $items]);

        // Get current cart items with product relationships
        if (Auth::check()) {
            $cart = CartItem::with([
                'product.images',
                'product.specialOffer' => function ($query) {
                    $query->where('status', 'active');
                },
                'product.sale' => function ($query) {
                    $query->where('status', 'active');
                }
            ])->where('user_id', Auth::id())->get();
        } else {
            $cart = collect(session()->get('cart', []));
        }

        foreach ($items as $requestItem) {
            $productId = $requestItem['product_id'];
            $newQuantity = $requestItem['quantity'];

            // Find the cart item that matches this product_id
            $cartItem = $cart->first(function ($item) use ($productId) {
                return (isset($item->product_id) ? $item->product_id : $item['product_id']) === $productId;
            });

            if ($cartItem && isset($cartItem->product)) {
                // Use centralized price calculation method
                $price = $this->calculateItemPrice($cartItem->product);

                $itemTotal = $price * $newQuantity;
                $itemTotals[$productId] = $itemTotal;
                $subtotal += $itemTotal;

                Log::info('Product calculation', [
                    'product_id' => $productId,
                    'price' => $price,
                    'quantity' => $newQuantity,
                    'item_total' => $itemTotal
                ]);

                // Calculate shipping charge using the actual product database ID
                $deliveryFee = $this->calculateTotalDeliveryFee($cart);
            } else {
                Log::warning('Cart item not found for product_id', ['product_id' => $productId]);
            }
        }

        $response = [
            'delivery_fee' => number_format($deliveryFee, 2),
            'subtotal' => number_format($subtotal, 2),
            'total' => number_format($subtotal + $deliveryFee, 2),
            'item_totals' => array_map(function($total) {
                return number_format($total, 2);
            }, $itemTotals),
            'success' => true
        ];

        Log::info('Cart calculation response', $response);

        return response()->json($response);

    } catch (Exception $e) {
        Log::error('Error calculating cart shipping', [
            'error' => $e->getMessage(),
            'items' => $request->input('items', [])
        ]);

        return response()->json([
            'error' => 'Failed to calculate shipping',
            'success' => false
        ], 500);
    }
}

/**
 * Centralized method to calculate item price with consistent logic
 */
private function calculateItemPrice($product)
{
    // Check if there's an active special offer first
    if ($product->specialOffer && $product->specialOffer->status === 'active') {
        return $product->specialOffer->offer_price;
    }

    // Check if there's an active sale
    if ($product->sale && $product->sale->status === 'active') {
        return $product->sale->sale_price;
    }

    // Default to normal price
    return $product->normal_price;
}

/**
 * Updated method to use consistent delivery fee calculation
 */
private function calculateTotalDeliveryFee($cart)
{
    $totalDeliveryFee = 0;

    foreach ($cart as $item) {
        $productId = isset($item->product_id) ? $item->product_id : $item['product_id'];
        $quantity = isset($item->quantity) ? $item->quantity : $item['quantity'];

        $shippingCharge = ShippingCharge::where('product_id', $productId)
            ->where('min_quantity', '<=', $quantity)
            ->where('max_quantity', '>=', $quantity)
            ->first();

        if ($shippingCharge) {
            $productDeliveryFee = $shippingCharge->charge;
            $totalDeliveryFee += $productDeliveryFee;
        } else {
            Log::warning("No matching shipping charge found for Product ID: {$productId}, Quantity: {$quantity}");
        }
    }

    return $totalDeliveryFee;
}
    private function calculateTotalDeliveryFeeAlternative($cart)
    {
        $totalDeliveryFee = 0;

        $groupedCart = $cart->groupBy(function ($item) {
            return isset($item->product_id) ? $item->product_id : $item['product_id'];
        });

        foreach ($groupedCart as $productId => $items) {
            $totalQuantity = $items->sum(function ($item) {
                return isset($item->quantity) ? $item->quantity : $item['quantity'];
            });
            $shippingCharge = ShippingCharge::where('product_id', $productId)
                ->where('min_quantity', '<=', $totalQuantity)
                ->where('max_quantity', '>=', $totalQuantity)
                ->first();

            if (!$shippingCharge) {
                $product = Products::find($productId);
                if ($product && $product->category_id) {
                    $shippingCharge = ShippingCharge::where('category_id', $product->category_id)
                        ->where('min_quantity', '<=', $totalQuantity)
                        ->where('max_quantity', '>=', $totalQuantity)
                        ->first();
                }
            }

            if (!$shippingCharge) {
                $shippingCharge = ShippingCharge::whereNull('product_id')
                    ->whereNull('category_id')
                    ->where('min_quantity', '<=', $totalQuantity)
                    ->where('max_quantity', '>=', $totalQuantity)
                    ->first();
            }

            if ($shippingCharge) {
                $productDeliveryFee = $shippingCharge->charge * $totalQuantity;
                $totalDeliveryFee += $productDeliveryFee;
            }
        }

        return $totalDeliveryFee;
    }


    public function checkout()
    {
        $user = auth()->user();
        $defaultAddress = Address::where('user_id', $user->id)->where('default', 1)->first();

        if (Auth::check()) {
            $cart = CartItem::with('product')->where('user_id', Auth::id())->get();
        } else {
            $cartItems = session()->get('cart', []);
            $cart = collect($cartItems)->map(function ($item) {
                $product = Products::where('product_id', $item['product_id'])->first();
                $item['product'] = $product;
                return (object) $item;
            });
        }
        $deliveryFee = $this->calculateTotalDeliveryFee($cart);

        return view('frontend.checkout', compact('cart', 'defaultAddress', 'user', 'deliveryFee'));
    }

    public function update(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        if (!$productId || !$quantity) {
            return response()->json(['success' => false, 'message' => 'Product ID or quantity missing'], 400);
        }

        if (Auth::check()) {
            $cartItem = CartItem::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->first();

            if ($cartItem) {
                $cartItem->quantity = $quantity;
                $cartItem->save();
                return response()->json(['success' => true, 'message' => 'Quantity updated successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Cart item not found'], 404);
            }
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] = $quantity;
                session()->put('cart', $cart);
                return response()->json(['success' => true, 'message' => 'Quantity updated successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Cart item not found in session'], 404);
            }
        }
    }




    public function removeFromCart(Request $request, $productId)
    {
        if (Auth::check()) {
            CartItem::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->delete();
        } else {
            $cart = session()->get('cart', []);
            // keep items that do NOT match productId
            $cart = array_values(array_filter($cart, function ($item) use ($productId) {
                return ($item['product_id'] ?? null) != $productId;
            }));
            session()->put('cart', $cart);
        }

        // optionally return the new count
        $cartCount = Auth::check()
            ? CartItem::where('user_id', Auth::id())->sum('quantity')
            : count(session()->get('cart', []));

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'cart_count' => $cartCount]);
        }

        return redirect()->back();
    }
}
