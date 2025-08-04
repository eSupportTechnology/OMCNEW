<?php

namespace App\Helpers;

use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartHelper
{
    public static function getMiniCartData()
    {
        $miniCart = [];

        if (Auth::check()) {
            $cartItems = CartItem::with([
                'product.sale',
                'product.specialOffer',
                'product.images' => function ($query) {
                    $query->orderBy('id');
                }
            ])
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

                $miniCart[] = [
                    'name' => $product->product_name,
                    'image' => $product->images->first()?->image_path ?? null,
                    'quantity' => $item->quantity,
                    'subtotal' => round($price, 2),
                    'product_id' => $product->product_id
                ];
            }
        }

        return $miniCart;
    }
}
