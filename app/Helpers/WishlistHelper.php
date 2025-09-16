<?php

namespace App\Helpers;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistHelper
{
    public static function getMiniWishlistData()
    {
        $miniWishlist = [];

        if (Auth::check()) {
            $wishlistItems = Wishlist::with([
                'product.sale',
                'product.specialOffer',
                'product.images' => function ($query) {
                    $query->orderBy('id');
                }
            ])
                ->where('user_id', Auth::id())
                ->get();

            foreach ($wishlistItems as $item) {
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

                $miniWishlist[] = [
                    'id'         => $item->id,
                    'product_id' => $product->product_id,
                    'name'       => $product->product_name,
                    'image'      => $product->images->first()?->image_path ?? null,
                    'price'      => round($price, 2),
                ];
            }
        }

        return $miniWishlist;
    }
}
