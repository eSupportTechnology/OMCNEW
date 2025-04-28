<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use Illuminate\Support\Facades\View;

class CategoryServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Share categories with all views
        View::composer('*', function ($view) {
            $categories = Category::with('subcategories.subSubcategories')->get();
            $view->with('categories', $categories);
        });
    }
}
