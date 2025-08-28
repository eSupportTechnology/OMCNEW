<?php

namespace App\Http\Controllers;

use App\Helpers\OnepayHelper;
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
use App\Models\ShippingCharge;
use App\Services\DialogSMSService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;


class PaymentController extends Controller
{

    public function payment($order_code)
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $customerOrder = CustomerOrder::where('order_code', $order_code)
        ->where('user_id', Auth::id())
        ->first();

    if (!$customerOrder) {
        return redirect()->route('home');
    }

    // Fetch order items with product sale/offer info
    $cart = $customerOrder->items()->with(['product.sale', 'product.specialOffer'])->get();

    // Calculate subtotal (sum of cost * quantity)
    $subtotal = $cart->sum(function ($item) {
        return $item->cost * $item->quantity;
    });

    // Calculate total quantity of all items
    $totalQuantity = $cart->sum('quantity');

    $deliveryFee = $this->calculateTotalDeliveryFee($cart);

    // Total = subtotal + delivery
    $total = $subtotal + $deliveryFee;

    // ✅ Update the order with calculated values
    $customerOrder->update([
        'total_cost'   => $total,
        'delivery_fee' => $deliveryFee,
    ]);

    return view('frontend.payment', compact(
        'customerOrder',
        'order_code',
        'subtotal',
        'deliveryFee',
        'total'
    ));
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

        // ✅ Send SMS to vendor
        try {
            $smsService = new DialogSMSService();
            $vendorMobile = env('SMS_PHONE_NUMBER'); // Change this to your vendor's actual mobile number
            $message = "New COD Order Received:\nOrder Code: {$order->order_code}\nTotal: Rs. {$order->total}";

            $smsService->sendSMS($vendorMobile, $message);
        } catch (\Exception $e) {
            Log::error('Failed to send SMS to vendor: ' . $e->getMessage());
        }

        return redirect()->route('order.thankyou', ['order_code' => $order_code])
            ->with('success', 'Order confirmed successfully with Cash on Delivery.');
    }

    public function confirmcardOrder($order_code)
    {
        try {
            $order = CustomerOrder::with(['user', 'items.product.sale', 'items.product.specialOffer'])
                ->where('order_code', $order_code)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            // 1. Calculate subtotal (cost * quantity for each item)
            $subtotal = $order->items->sum(function ($item) {
                return $item->cost * $item->quantity;
            });

            // 2. Calculate total quantity for shipping fee lookup
            $totalQuantity = $order->items->sum('quantity');

            // 3. Get delivery fee
            $shippingCharge = ShippingCharge::where('min_quantity', '<=', $totalQuantity)
                ->where('max_quantity', '>=', $totalQuantity)
                ->first();

            $deliveryFee = $shippingCharge->charge ?? 0;

            // 4. Calculate final total
            $total = $subtotal + $deliveryFee;

            // 5. Update order total_cost and fees
            $order->update([
                'payment_method' => 'Card',
                'payment_status' => 'Pending',
                'total_cost'     => $total,
                'delivery_fee'   => $deliveryFee,
            ]);

            // 6. Prepare for payment
            $amount    = $total;
            $currency  = 'LKR';
            $hash      = OnepayHelper::generateHash($currency, $amount);
            $reference = 'OMCORD_' . time();

            Log::info('Initiating OnePay Payment', [
                'currency'                 => $currency,
                'app_id'                   => config('onepay.app_id'),
                'hash'                     => $hash,
                'amount'                   => number_format($amount, 2, '.', ''),
                'reference'                => $reference,
                'customer_first_name'      => $order->customer_fname,
                'customer_last_name'       => optional($order->user)->name ?? 'Unknown',
                'customer_phone_number'    => $order->phone,
                'customer_email'           => $order->email,
                'transaction_redirect_url' => route('order.thankyou', ['order_code' => $order_code]),
                'additional_data'          => $reference,
            ]);

            $response = Http::withHeaders([
                'Authorization' => config('onepay.api_key'),
            ])->post(config('onepay.base_url') . '/checkout/link/', [
                'currency'                 => $currency,
                'app_id'                   => config('onepay.app_id'),
                'hash'                     => $hash,
                'amount'                   => $amount,
                'reference'                => $reference,
                'customer_first_name'      => $order->customer_fname,
                'customer_last_name'       => optional($order->user)->name ?? 'Unknown',
                'customer_phone_number'    => $order->phone,
                'customer_email'           => $order->email,
                'transaction_redirect_url' => route('order.thankyou', ['order_code' => $order_code]),
                'additional_data'          => $reference,
            ]);

            Log::info('OnePay Payment Response', [
                'status' => $response->status(),
                'body'   => $response->json(),
            ]);

            if ($response->successful() && isset($response['data']['gateway']['redirect_url'])) {
                $redirectUrl = $response['data']['gateway']['redirect_url'];

                Log::info('Redirecting to OnePay', ['url' => $redirectUrl]);

                $order->update([
                    'transaction_id' => $reference,
                ]);

                return redirect()->away($redirectUrl);
            }

            Log::error('OnePay payment failed or missing redirect URL', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);

            return redirect()->back()->with('error', 'Payment initiation failed. Please try again.');
        } catch (\Exception $e) {
            Log::error('Error in confirmcardOrder', [
                'message' => $e->getMessage(),
                'line'    => $e->getLine(),
                'file'    => $e->getFile(),
            ]);

            return redirect()->back()->with('error', 'Failed to confirm order. Please try again.');
        }
    }



    public function getOrderDetails($order_code)
    {

        $order = CustomerOrder::where('order_code', $order_code)->first();
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }
        if ($order->payment_status == "Not Paid") {
            return view('frontend.place_order', [
                'order_code' => $order_code,
                'total_cost' => $order->total_cost,
            ]);
        }

        if ($order->payment_status != "Paid") {
            return redirect()->route('order.payment-fail')->with('error', 'Order not found.');
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

    public function getPaymentInfo(Request $request)
    {
        Log::info("this is working");
        Log::info('Original response from onepay : ', ['response' => $request]);

        try {
            $statusMessage = $request->input('status_message');
            $reference = $request->input('additional_data');

            // Find the order by the transaction_id (stored as additional_data / reference)
            $order = CustomerOrder::where('transaction_id', $reference)->first();

            if (!$order) {
                Log::error('Order not found for transaction reference: ' . $reference);
                return redirect()->route('order.payment-fail')->with('error', 'Order not found.');
            }

            if (strtoupper($statusMessage) === 'SUCCESS') {
                $order->update(['payment_status' => 'Paid']);
                Log::info('Order marked as Paid', ['order_code' => $order->order_code]);

                // ✅ Send SMS to vendor
                try {
                    $smsService = new DialogSMSService();
                    $vendorMobile = env('SMS_PHONE_NUMBER'); // Change this to your vendor's actual mobile number
                    $message = "New Card Order Received:\nOrder Code: {$order->order_code}\nTotal: Rs. {$order->total}";

                    $smsService->sendSMS($vendorMobile, $message);
                } catch (\Exception $e) {
                    Log::error('Failed to send SMS to vendor: ' . $e->getMessage());
                }

                return response()->json(['message' => 'Payment confirmed and order updated.']);
            } else {
                Log::warning('Payment failed or not successful', ['status_message' => $statusMessage]);
                return redirect()->route('order.payment-fail')->with('error', 'Payment was not successful.');
            }
        } catch (\Exception $e) {
            Log::error('Error handling payment callback', [
                'message' => $e->getMessage(),
                'line'    => $e->getLine(),
                'file'    => $e->getFile(),
            ]);

            return redirect()->route('order.payment-fail')->with('error', 'An error occurred while processing the payment.');
        }
    }

    public function paymentFail()
    {
        return view('frontend.payment-fail');
    }

    private function calculateTotalDeliveryFee($cart)
    {
        $totalDeliveryFee = 0;

        foreach ($cart as $item) {
            $productId = isset($item->product_id) ? $item->product_id : $item['product_id'];
            $quantity = isset($item->quantity) ? $item->quantity : $item['quantity'];

            $allChargesForProduct = ShippingCharge::where('product_id', $productId)->get();

            $shippingCharge = ShippingCharge::where('product_id', $productId)
                ->where('min_quantity', '<=', $quantity)
                ->where('max_quantity', '>=', $quantity)
                ->first();

            if ($shippingCharge) {
                $productDeliveryFee = $shippingCharge->charge;
                $totalDeliveryFee += $productDeliveryFee;

            } else {
                Log::warning("No matching shipping charge found for Product ID: {$productId}, Quantity: {$quantity}");
            }
        }

        return $totalDeliveryFee;
    }
}
