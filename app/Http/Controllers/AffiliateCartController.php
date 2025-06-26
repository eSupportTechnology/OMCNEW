<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AffiliateCartItem;
use App\Models\Products;

class AffiliateCartController extends Controller
{
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');

        if (!$productId) {
            return response()->json(['error' => 'Product ID is required.'], 400);
        }

        $product = Products::where('product_id', $productId)->first();

        if (!$product) {
            return response()->json(['error' => 'Product not found.'], 404);
        }

        if (Auth::check()) {
            $user = Auth::user();

            $item = AffiliateCartItem::where('user_id', $user->id)
                ->where('product_id', $productId)
                ->first();

            if ($item) {
                $item->quantity += 1;
                $item->save();
            } else {
                AffiliateCartItem::create([
                    'user_id' => $user->id,
                    'product_id' => $productId,
                    'quantity' => 1,
                    'size' => $request->input('size'),
                    'color' => $request->input('color'),
                    'image' => $request->input('image'),
                ]);
            }
        } else {
            // Handle guest session cart
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
                    'size' => $request->input('size'),
                    'color' => $request->input('color'),
                    'image' => $request->input('image'),
                ];
            }

            session()->put('cart_affiliate', $cart);
        }

        $cartCount = Auth::check()
            ? AffiliateCartItem::where('user_id', Auth::id())->sum('quantity')
            : array_sum(array_column(session()->get('cart_affiliate', []), 'quantity'));

        return response()->json(['cart_count' => $cartCount]);
    }
}
