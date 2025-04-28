<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
{
    // Share wishlist data globally
    View::composer('*', function ($view) {
        if (auth()->check()) {
            $userId = auth()->id();
            $wishlistItems = Wishlist::where('user_id', $userId)
                ->with('product')  
                ->get();

            // Extract product IDs from wishlist items
            $wishlistProductIds = $wishlistItems->pluck('product_id')->toArray();

            $wishlistCount = $wishlistItems->count();
        } else {
            // For guests, use session data
            $wishlistItems = collect();
            $wishlistProductIds = []; 
            $wishlistCount = count(session()->get('wishlist', []));
        }

        // Share data with all views
        $view->with('wishlistItems', $wishlistItems);
        $view->with('wishlistProductIds', $wishlistProductIds);  
        $view->with('wishlistCount', $wishlistCount);
    });
}

}
