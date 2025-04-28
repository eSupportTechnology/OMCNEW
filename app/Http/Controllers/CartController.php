<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Address;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{

    
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $size = $request->input('size'); 
        $color = $request->input('color'); 
    
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
                $item->quantity += 1; 
                $item->save();
            } else {
                CartItem::create([
                    'user_id' => $user->id,
                    'product_id' => $productId,
                    'quantity' => 1,
                    'size' => $size,
                    'color' => $color 
                ]);
            }
        } else {
            $cart = session()->get('cart', []);
            $itemFound = false;
    
            foreach ($cart as &$item) {
                if ($item['product_id'] === $productId && $item['size'] === $size && $item['color'] === $color) {
                    $item['quantity'] += 1; // Increment quantity if the item is already in the cart
                    $itemFound = true;
                    break;
                }
            }
    
            if (!$itemFound) {
                $cart[] = [
                    'product_id' => $productId,
                    'quantity' => 1,
                    'size' => $size,
                    'color' => $color 
                ];
            }
    
            session()->put('cart', $cart);
        }
    
        $cartCount = Auth::check() ? CartItem::where('user_id', Auth::id())->sum('quantity') : array_sum(array_column(session()->get('cart', []), 'quantity'));
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
    
    


    public function showCart()
    {
        if (Auth::check()) {
            $cart = CartItem::with(['product.images', 'product.specialOffer' => function($query) {
                $query->where('status', 'active');
            }, 'product.sale' => function($query) {
                $query->where('status', 'active');
            }])->where('user_id', Auth::id())->get();
        } else {
            $cart = session()->get('cart', []);
        }
    
        return view('frontend.cart', compact('cart'));
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

        return view('frontend.checkout', compact('cart', 'defaultAddress', 'user'));
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
    
    


    public function removeFromCart($productId)
    {
    
        if (Auth::check()) {
            $user = Auth::user();
            CartItem::where('user_id', $user->id)
                    ->where('product_id', $productId)
                    ->delete();
        } else {
            $cart = session()->get('cart', []);
    
            foreach ($cart as $index => $item) {
                if ($item['product_id'] == $productId) {
                    unset($cart[$index]);
                    $cart = array_values($cart); 
                    session()->put('cart', $cart);
                    break;
                }
            }
        }
    
        $cartCount = Auth::check() ? CartItem::where('user_id', Auth::id())->sum('quantity') : count(session()->get('cart', []));
        return response()->json(['cart_count' => $cartCount]);
    }
    
    
    

}
