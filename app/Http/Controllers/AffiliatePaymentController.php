<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Affiliate_User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderItems;
use Illuminate\Support\Facades\DB;


class AffiliatePaymentController extends Controller
{
    public function payment($order_code)
{
    $deliveryFee = 300;
    $subtotal = 0;
    $total = 0;

    // Check if affiliate user is logged in via session
    $affiliateUserId = Session::get('customer_id');

    if ($affiliateUserId) {
        // Find the order that belongs to the affiliate user
        $customerOrder = CustomerOrder::where('order_code', $order_code)
                            ->where('user_id', $affiliateUserId)
                            ->first();

        if (!$customerOrder) {
            return redirect()->route('home');
        }

        // Load cart items with related sale and specialOffer
        $cart = $customerOrder->items()->with(['product.sale', 'product.specialOffer'])->get();

        // Get total and subtotal
        $total = $customerOrder->total_cost;
        $subtotal = $customerOrder->items()
            ->select(DB::raw('SUM(cost * quantity) as subtotal'))
            ->value('subtotal');

        // Calculate delivery fee
        $deliveryFee = $total - $subtotal;

        return view('affiliate_dashboard.affiliate_payment', compact('customerOrder', 'order_code', 'subtotal', 'deliveryFee', 'total'));
    } else {
        // Redirect to affiliate login page if session not found
        return redirect()->route('aff_home')->withErrors(['session' => 'Please log in first.']);
    }
}
}
