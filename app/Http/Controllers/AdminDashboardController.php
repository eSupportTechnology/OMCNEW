<?php

namespace App\Http\Controllers;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderItems;
use App\Models\User;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; 


class AdminDashboardController extends Controller
{
   

    public function index()
    {
        $orderCount = CustomerOrder::count();
        $customerCount = User::where('role', 'customer')->count();
        $productCount = Products::count();
        $totalCostToday = CustomerOrder::whereDate('created_at', Carbon::today())
        ->sum('total_cost');
    
        // Fetch sales for the last 12 months
        $salesData = CustomerOrder::select(
                DB::raw('SUM(total_cost) as total_sales'), 
                DB::raw('MONTH(date) as month')
            )
            ->where('date', '>=', now()->subYear()) // last 12 months
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total_sales', 'month')
            ->toArray();
    

        // Fill missing months with 0 sales
        $salesIn12Months = [];
        for ($i = 1; $i <= 12; $i++) {
            $salesIn12Months[$i] = $salesData[$i] ?? 0; 
        }
    

        // Fetch top 5 products based on order count
        $topProducts = CustomerOrderItems::select('product_id', DB::raw('count(*) as total_count'))
            ->groupBy('product_id')
            ->orderBy('total_count', 'desc')
            ->take(5)
            ->get()
            ->map(function ($item) {
                $product = Products::where('product_id', $item->product_id)->first();
    
                return [
                    'name' => $product ? $product->product_name : 'Unknown Product',
                    'count' => $item->total_count,
                ];
            });

          
        return view('admin_dashboard.index', compact('orderCount', 'customerCount', 'productCount', 'totalCostToday', 'topProducts', 'salesIn12Months'));
    }
    


    


}




