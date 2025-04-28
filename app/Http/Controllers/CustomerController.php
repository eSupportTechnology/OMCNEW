<?php

namespace App\Http\Controllers;
use App\Models\CustomerOrder;
use App\Models\User;
use App\Models\Review;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function show_customers()
    {

        $customers = User::withCount(['customerOrders'])
        ->get()
        ->map(function ($customer) {
            if ($customer->last_login) {
                $customer->status = now()->diffInDays($customer->last_login) <= 30 ? 'Active' : 'Inactive';
            } else {
                $customer->status = 'Inactive';
            }
            return $customer;
        });
    
    return view('admin_dashboard.customers', compact('customers'));
    
    }


    public function showCustomerDetails($user_id)
    {

        $customer = User::findOrFail($user_id);
        
        $orders = CustomerOrder::where('user_id', $user_id)
            ->with('items.product')
            ->get();
        
        $totalCost = $orders->sum('total_cost');
        $totalOrders = $orders->count();
        $totalProducts = $orders->sum(function ($order) {
            return $order->items->sum('quantity');
        });
        
        $totalReviews = Review::where('user_id', $user_id)->count();

        return view('admin_dashboard.customer-details', compact('customer', 'orders', 'totalCost', 'totalOrders', 'totalProducts', 'totalReviews'));
    }
    
    


}
