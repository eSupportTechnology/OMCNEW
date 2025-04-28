<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Sale;
use App\Models\CustomerOrderItems;
use App\Models\Products;
use App\Models\SpecialOffers;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

  
    public function index()
    {
        // Fetching recent products added within the last week and eager load reviews
        $recentProducts = Products::with(['images', 'reviews' => function ($query) {
                $query->where('status', 'published');
            }])
            ->where('created_at', '>=', now()->subWeek()) 
            ->take(8) // Limit to 6 products
            ->get()
            ->map(function ($product) {
                $product->average_rating = $product->reviews->avg('rating');
                $product->rating_count = $product->reviews->count();
                return $product;
            });
    
        // Fetching special offers and eager load reviews
        $specialOffers = SpecialOffers::with(['product.images', 'product.reviews' => function ($query) {
                $query->where('status', 'published');
            }])
            ->where('status', 'active')
            ->take(5)
            ->get()
            ->map(function ($offer) {
                $offer->product->average_rating = $offer->product->reviews->avg('rating');
                $offer->product->rating_count = $offer->product->reviews->count();
                return $offer;
            });
    
        // Fetching flash sales and eager load reviews
        $flashSales = Sale::with(['product.images', 'product.reviews' => function ($query) {
                $query->where('status', 'published');
            }])
            ->where('status', 'active')
            ->where('end_date', '>=', now()) 
            ->take(6)
            ->get()
            ->map(function ($sale) {
                $sale->product->average_rating = $sale->product->reviews->avg('rating');
                $sale->product->rating_count = $sale->product->reviews->count();
                return $sale;
            });
    
        // Get the most ordered products along with their quantities
        $orderedProductsIds = CustomerOrderItems::select('product_id')
            ->selectRaw('SUM(quantity) as total_quantity') 
            ->groupBy('product_id') 
            ->orderBy('total_quantity', 'desc')
            ->pluck('product_id'); 
    
        // Fetch actual product models based on ordered product IDs
        $orderedProducts = Products::with('images')
            ->whereIn('product_id', $orderedProductsIds)
            ->with(['reviews' => function ($query) {
                $query->where('status', 'published');
            }])
            ->get()
            ->map(function ($product) {
                $product->average_rating = $product->reviews->avg('rating');
                $product->rating_count = $product->reviews->count();
                return $product;
            });
    
        // Fetching categories
        $categories = Category::with('subcategories.subSubcategories')->get();
    
        // Returning to the view
        return view('frontend.home', [
            'categories' => $categories,
            'specialOffers' => $specialOffers,
            'flashSales' => $flashSales,
            'recentProducts' => $recentProducts,
            'orderedProducts' => $orderedProducts,
        ]);
    }
    
    
    

    

    
}
