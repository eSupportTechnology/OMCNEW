<?php

namespace App\Providers;

use App\Helpers\CartHelper;
use App\Models\CartItem;
use App\Models\Logo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $view->with('siteLogo', Logo::first());
        });

        View::composer('frontend.partials.mini-cart', function ($view) {
            $view->with('miniCart', CartHelper::getMiniCartData());
        });
    }
}