<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomerOrder;
use App\Models\Products;
use App\Models\Variation;
use App\Models\CustomerOrderItems;
use App\Models\RaffleTicket;
use App\Models\AffiliateReferral;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CustomerOrderController extends Controller
{


    public function trackReferral($tracking_id, $product_id, $quantity = 1)
    {
        // Find the raffle ticket by the tracking ID
        $raffleTicket = RaffleTicket::where('token', $tracking_id)->first();

        if ($raffleTicket) {
            $referral = AffiliateReferral::where('raffle_ticket_id', $raffleTicket->id)
                ->where('product_url', 'like', '%' . $product_id . '%')
                ->first();

            if ($referral) {
                // Retrieve the product details
                $product = Products::where('product_id', $product_id)->first();

                if ($product && $product->affiliate_price) {
                    // Commission calculation (based on product settings)
                    $commission = ($product->commission_percentage / 100) * $product->affiliate_price;

                    // Increment referral count
                    $referral->increment('referral_count');

                    // Add commission * quantity
                    $referral->total_affiliate_price += ($commission * $quantity);

                    $referral->save();
                }
            }
        }
    }

    public function store(Request $request)
    {

        $request->validate([
            'first_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'company_name' => 'nullable|string|max:255',
            'apartment' => 'nullable|string|max:255',
        ]);

        $cart = Auth::check() ? CartItem::where('user_id', Auth::id())->with('product')->get() : collect(session('cart', []));

        // Check if cart is empty
        if ($cart->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty. Add some items to proceed.');
        }

        $cartArray = $cart->map(function ($item) {
            $price = $item->product->sale && $item->product->sale->status === 'active'
                ? $item->product->sale->sale_price
                : ($item->product->specialOffer && $item->product->specialOffer->status === 'active'
                    ? $item->product->specialOffer->offer_price
                    : $item->product->normal_price);

            return [
                'product_id' => $item->product_id,
                'price' => $price,
                'quantity' => $item->quantity,
                'size' => $item->size,
                'color' => $item->color,
            ];
        })->toArray();

        $subtotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cartArray));
        $shipping = 300;
        $total = $subtotal + $shipping;

        $orderCode = 'ORD-' . substr((string) Str::uuid(), 0, 8);

        $orderData = [
            'order_code' => $orderCode,
            'customer_fname' => $request->input('first_name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'company_name' => $request->input('company_name'),
            'address' => $request->input('address'),
            'apartment' => $request->input('apartment'),
            'city' => $request->input('city'),
            'postal_code' => $request->input('postal_code'),
            'date' => Carbon::now()->format('Y-m-d'),
            'total_cost' => $total,
            'discount' => 0,
            'user_id' => Auth::id(),
            'status' => 'Confirmed',
            // 'tracking_id' => $request->input('tracking_id') ?? null

        ];
        $order = CustomerOrder::create($orderData);

        foreach ($cartArray as $item) {

            $tracking_id = session('tracking_id'); // Retrieve the tracking ID from session
            // $this->trackReferral($tracking_id, $item['product_id'], $item['quantity']);

            CustomerOrderItems::create([
                'order_code' => $orderCode,
                'product_id' => $item['product_id'],
                'date' => Carbon::now()->format('Y-m-d'),
                'cost' => $item['price'],
                'quantity' => $item['quantity'],
                'size' => $item['size'],
                'color' => $item['color'],
            ]);

            // Reduce product quantity in Products and Variations table
            $product = Products::where('product_id', $item['product_id'])->first();
            if ($product) {
                $product->quantity -= $item['quantity'];
                $product->save();
            }

            // Handle size variation
            $sizeVariation = Variation::where('product_id', $item['product_id'])
                ->where('type', 'size')
                ->where('value', $item['size'])
                ->first();

            if ($sizeVariation && $sizeVariation->quantity >= $item['quantity']) {
                $sizeVariation->quantity -= $item['quantity'];
                $sizeVariation->save();
            }


            // Handle color variation
            $colorVariation = Variation::where('product_id', $item['product_id'])
                ->where('type', 'color')
                ->where('value', $item['color'])
                ->first();

            if ($colorVariation && $colorVariation->quantity >= $item['quantity']) {
                $colorVariation->quantity -= $item['quantity'];
                $colorVariation->save();
            }
        }


        return redirect()->route('payment', ['order_code' => $orderCode]);
    }




    public function buynowstore(Request $request)
    {

        try {
            // Validate the request data
            $request->validate([
                'first_name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'email' => 'required|email|max:255',
                'address' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'postal_code' => 'required|string|max:10',
                'company_name' => 'nullable|string|max:255',
                'apartment' => 'nullable|string|max:255',
                'size' => 'nullable|string|max:255',
                'color' => 'nullable|string|max:255',
                'quantity' => 'required|integer|min:1',
            ]);

            // Find the product
            $product = Products::where('product_id', $request->product_id)->first();

            // Set quantity and price
            $quantity = $request->input('quantity', 1);
            $price = $product->sale && $product->sale->status === 'active'
                ? $product->sale->sale_price
                : ($product->specialOffer && $product->specialOffer->status === 'active'
                    ? $product->specialOffer->offer_price
                    : $product->normal_price);

            $subtotal = $price * $quantity;
            $shipping = 300;
            $total = $subtotal + $shipping;

            // Generate order code
            $orderCode = 'ORD-' . substr((string) Str::uuid(), 0, 8);

            // Order data
            $orderData = [
                'order_code' => $orderCode,
                'customer_fname' => $request->input('first_name'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'company_name' => $request->input('company_name'),
                'address' => $request->input('address'),
                'apartment' => $request->input('apartment'),
                'city' => $request->input('city'),
                'postal_code' => $request->input('postal_code'),
                'date' => Carbon::now()->format('Y-m-d'),
                'total_cost' => $total,
                'discount' => 0,
                'user_id' => Auth::id(),
                'status' => 'Confirmed',
                // 'tracking_id' => $request->input('tracking_id') ?? null

            ];
            // Create the order
            $order = CustomerOrder::create($orderData);

            // Insert the order item into the order items table
            CustomerOrderItems::create([
                'order_code' => $orderCode,
                'product_id' => $product->product_id,
                'date' => Carbon::now()->format('Y-m-d'),
                'cost' => $price,
                'quantity' => $quantity,
                'size' => $request->input('size'),
                'color' => $request->input('color'),
            ]);

            // Reduce product quantity in the Products table
            $product->quantity -= $quantity;
            $product->save();

            // Handle size variation (if applicable)
            $sizeVariation = Variation::where('product_id', $product->product_id)
                ->where('type', 'size')
                ->where('value', $request->input('size'))
                ->first();

            if ($sizeVariation && $sizeVariation->quantity >= $quantity) {
                $sizeVariation->quantity -= $quantity;
                $sizeVariation->save();
            } elseif ($sizeVariation) {
                Log::warning('Not enough size variation quantity', [
                    'product_id' => $product->product_id,
                    'size' => $request->input('size'),
                    'required_quantity' => $quantity,
                    'available_quantity' => $sizeVariation->quantity
                ]);
            }

            // Handle color variation (if applicable)
            $colorVariation = Variation::where('product_id', $product->product_id)
                ->where('type', 'color')
                ->where('value', $request->input('color'))
                ->first();

            if ($colorVariation && $colorVariation->quantity >= $quantity) {
                $colorVariation->quantity -= $quantity;
                $colorVariation->save();
            } elseif ($colorVariation) {
                Log::warning('Not enough color variation quantity', [
                    'product_id' => $product->product_id,
                    'color' => $request->input('color'),
                    'required_quantity' => $quantity,
                    'available_quantity' => $colorVariation->quantity
                ]);
            }
            // $this->trackReferral(session('tracking_id'), $product->product_id, $quantity);
            // Redirect to payment
            return redirect()->route('payment', ['order_code' => $orderCode]);
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error processing Buy Now order', [
                'exception' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Redirect with error message
            return redirect()->back()->with('error', 'An error occurred while processing your order. Please try again.');
        }
    }

    public function updatePaymentStatus(Request $request, $id)
    {
        $order = CustomerOrder::findOrFail($id);
        $previousStatus = $order->payment_status;

        $order->payment_status = $request->payment_status;
        $order->save();

        if ($previousStatus !== 'Paid' && $order->payment_status === 'Paid') {
            app(\App\Http\Controllers\CustomerOrderController::class)->processAffiliateCommissions($order);
        }

        return redirect()->back()->with('success', 'Payment status updated successfully!');
    }


    private function processAffiliateCommissions(CustomerOrder $order)
    {
        if (!$order->tracking_id) {
            return;
        }

        $orderItems = CustomerOrderItems::where('order_code', $order->order_code)->get();

        foreach ($orderItems as $item) {
            $this->trackReferral($order->tracking_id, $item->product_id, $item->quantity);
        }
    }
}
