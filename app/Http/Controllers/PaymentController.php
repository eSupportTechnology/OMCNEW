<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomerOrder;
use App\Models\Products;
use App\Models\Variation;
use App\Models\CustomerOrderItems;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;
use App\Models\Affiliate_User;
use Carbon\Carbon;
use App\Models\PaymentRequest;
use Illuminate\Support\Facades\Session;


class PaymentController extends Controller
{

    // public function payment($order_code)
    // {

    //     if (Auth::check()) {
    //         $cart = CartItem::with('product')->where('user_id', Auth::id())->get();
    //     } else {
    //         $cartItems = session()->get('cart', []);
    //         $cart = collect($cartItems)->map(function ($item) {
    //             $product = Products::where('product_id', $item['product_id'])->first();
    //             $item['product'] = $product;
    //             return (object) $item;
    //         });
    //     }
    //     return view('frontend.payment', compact('cart', 'order_code'));
    // }

    // public function payment($order_code)
    // {

    //     $deliveryFee = 300;
    //     $subtotal = 0;

    //     if (Auth::check()) {
    //         $cart = CartItem::with(['product.sale', 'product.specialOffer'])
    //             ->where('user_id', Auth::id())->get();
    //     } else {
    //         $cartItems = session()->get('cart', []);
    //         $cart = collect($cartItems)->map(function ($item) {
    //             $product = Products::with(['sale', 'specialOffer'])->where('product_id', $item['product_id'])->first();
    //             $item['product'] = $product;
    //             return (object) $item;
    //         });
    //     }

    //     foreach ($cart as $item) {
    //         $price = $item->product->sale && $item->product->sale->status === 'active'
    //             ? $item->product->sale->sale_price
    //             : ($item->product->specialOffer && $item->product->specialOffer->status === 'active'
    //                 ? $item->product->specialOffer->offer_price
    //                 : $item->product->normal_price);

    //         $subtotal += $price * ($item->quantity ?? 1);
    //     }

    //     $total = $subtotal + $deliveryFee;

    //     return view('frontend.payment', compact('cart', 'order_code', 'subtotal', 'deliveryFee', 'total'));
    // }

    public function payment($order_code)
    {

        $deliveryFee = 300;
        $subtotal = 0;

        if (Auth::check()) {
            $customerOrder = CustomerOrder::where('order_code', $order_code)->where('user_id', Auth::id())->first();
            if ($customerOrder) {
                $cart = $customerOrder->items()->with(['product.sale', 'product.specialOffer'])->get();
            } else {
                return redirect()->route('home');
            }

            $total= $customerOrder->total_cost;
            $subtotal = $customerOrder->items()
                ->select(DB::raw('SUM(cost * quantity) as subtotal'))
                ->value('subtotal');

            $deliveryFee = $total - $subtotal;
        } else {
            return redirect()->route('login');
        }



        return view('frontend.payment', compact('customerOrder', 'order_code', 'subtotal', 'deliveryFee', 'total'));
    }



    public function confirmCod(Request $request, $order_code)
    {
        $order = CustomerOrder::where('order_code', $order_code)->first();
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        if (Auth::check()) {
            $order->update([
                'payment_method' => 'COD',
                'payment_status' => 'Not Paid',
            ]);

            CartItem::where('user_id', Auth::id())->delete();
        } else {
            $order->update([
                'payment_method' => 'COD',
                'payment_status' => 'Not Paid',
            ]);

            session()->forget('cart');
        }

        return redirect()->route('order.thankyou', ['order_code' => $order_code])
            ->with('success', 'Order confirmed successfully with Cash on Delivery.');
    }

    public function confirmcardOrder($order_code)
    {
        try {
            $order = CustomerOrder::where('order_code', $order_code)->where('user_id', Auth::id())->firstOrFail();

            // Update the payment method and payment status
            $order->update([
                'payment_method' => 'Card',
                'payment_status' => 'Paid',
            ]);

            return redirect()->route('order.thankyou', ['order_code' => $order_code])
                ->with('success', 'Order confirmed successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to confirm order. Please try again.');
        }
    }



    public function getOrderDetails($order_code)
    {

        $order = CustomerOrder::where('order_code', $order_code)->first();
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }
        return view('frontend.order_received', [
            'order_code' => $order_code,
            'total_cost' => $order->total_cost,
        ]);
    }

    public function bank_acc()
    {

        return view('affiliate_dashboard.bank_acc');
    }



    public function updatebank(Request $request)
    {

        // Validate the form data
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
        ]);

        // Get the authenticated customer
        $customerId = Session::get('customer_id');
        $customer = Affiliate_User::findOrFail($customerId);

        //dd($customer);

        // Update the customer's bank account details
        $customer->update([
            'bank_name' => $request->input('bank_name'),
            'branch' => $request->input('branch'),
            'account_name' => $request->input('account_name'),
            'account_number' => $request->input('account_number'),
        ]);

        // Redirect back with a success message
        return redirect()->route('payment_info')->with('success', 'Bank account details added successfully.');
    }

    public function paymentRequest(Request $request)
    {

        // Validate the form input
        $request->validate([
            'withdraw_amount' => 'required|numeric',
            'total' => 'required|numeric|min:1000',
        ]);



        // Get the customer ID from the session (assuming customer_id is stored in the session)
        $customerId = Session::get('customer_id');

        // Ensure the total balance is more than 1000
        if ($request->total < 1000) {
            return redirect()->back()->with('error', 'Your total value must be more than 1000.');
        }

        if ($request->total < $request->withdraw_amount) {
            return redirect()->back()->with('error', 'Your Request value must be lover than Your Total Value.');
        }


        // Get the user's bank details from Affiliate_User
        $customer = Affiliate_User::findOrFail($customerId);

        if (!$customer || !$customer->account_number) {
            return redirect()->back()->with('error', 'No valid bank details found for the user.');
        }

        //dd($customer);
        // Store the payment request in the payment_requests table
        $paymentRequest = PaymentRequest::create([
            'user_id' => $customerId,
            'withdraw_amount' => $request->input('withdraw_amount'),
            'bank_name' => $customer->bank_name,
            'branch' => $customer->branch,
            'account_name' => $customer->account_name,
            'account_number' => $customer->account_number,
            'status' => 'Pending', // Default status is pending
            'requested_at' => now(),
        ]);

        return redirect()->route('withdrawals')->with('success', 'Your payment request has been submitted and will be processed within 48 hours.');
    }
}
