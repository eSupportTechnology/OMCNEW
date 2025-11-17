<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Helpers\OnepayHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderItems;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Services\DialogSMSService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    /**
     * ✅ FIXED: Get payment details with correct delivery fee calculation
     */
    public function getPaymentDetails($orderCode)
    {
        try {
            $order = CustomerOrder::where('order_code', $orderCode)
                ->where('user_id', Auth::id())
                ->with(['orderItems.product.images'])
                ->first();

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found'
                ], 404);
            }

            // ✅ Calculate subtotal from order items
            $subtotal = $order->orderItems()
                ->select(DB::raw('SUM(cost * quantity) as subtotal'))
                ->value('subtotal') ?? 0;

            $total = $order->total_cost;
            
            // ✅ Delivery fee = total - subtotal (already calculated during order creation)
            $deliveryFee = $total - $subtotal;

            Log::info('Payment details calculated', [
                'order_code' => $orderCode,
                'subtotal' => $subtotal,
                'delivery_fee' => $deliveryFee,
                'total' => $total
            ]);

            return response()->json([
                'success' => true,
                'data' => [
                    'order' => [
                        'order_code' => $order->order_code,
                        'customer_name' => $order->customer_fname,
                        'email' => $order->email,
                        'phone' => $order->phone,
                        'address' => $order->address,
                        'city' => $order->city,
                        'postal_code' => $order->postal_code,
                        'status' => $order->status,
                        'payment_status' => $order->payment_status ?? 'Not Paid',
                        'payment_method' => $order->payment_method,
                        'transaction_id' => $order->transaction_id,
                    ],
                    'pricing' => [
                        'subtotal' => round($subtotal, 2),
                        'delivery_fee' => round($deliveryFee, 2),
                        'total' => round($total, 2),
                    ],
                    'items' => $order->orderItems->map(function ($item) {
                        return [
                            'product_id' => $item->product_id,
                            'product_name' => $item->product->product_name ?? 'Unknown Product',
                            'quantity' => $item->quantity,
                            'cost' => (double) $item->cost,
                            'size' => $item->size,
                            'color' => $item->color,
                            'material' => $item->material,
                            'total' => round($item->cost * $item->quantity, 2),
                            'image' => $item->product->images->first()?->image_url ?? null,
                        ];
                    }),
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error getting payment details', [
                'error' => $e->getMessage(),
                'order_code' => $orderCode
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to get payment details',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Confirm Cash on Delivery payment
     */
    public function confirmCOD(Request $request, $orderCode)
    {
        try {
            $order = CustomerOrder::where('order_code', $orderCode)
                ->where('user_id', Auth::id())
                ->first();

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found'
                ], 404);
            }

            $order->update([
                'payment_method' => 'COD',
                'payment_status' => 'Not Paid',
            ]);

            // Clear user's cart
            CartItem::where('user_id', Auth::id())->delete();

            // Send SMS to vendor
            try {
                $smsService = new DialogSMSService();
                $vendorMobile = env('SMS_PHONE_NUMBER');
                $message = "New COD Order Received:\nOrder Code: {$order->order_code}\nTotal: Rs. {$order->total_cost}";
                $smsService->sendSMS($vendorMobile, $message);
            } catch (\Exception $e) {
                Log::error('Failed to send SMS to vendor: ' . $e->getMessage());
            }

            return response()->json([
                'success' => true,
                'message' => 'Order confirmed successfully with Cash on Delivery',
                'data' => [
                    'order_code' => $order->order_code,
                    'payment_method' => 'COD',
                    'payment_status' => 'Not Paid',
                    'total_cost' => round($order->total_cost, 2),
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error confirming COD', [
                'error' => $e->getMessage(),
                'order_code' => $orderCode
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to confirm COD payment'
            ], 500);
        }
    }

    /**
     * Initiate card payment
     */
    public function initiateCardPayment(Request $request, $orderCode)
    {
        try {
            $order = CustomerOrder::with('user')
                ->where('order_code', $orderCode)
                ->where('user_id', Auth::id())
                ->first();

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found'
                ], 404);
            }

            $order->update([
                'payment_method' => 'Card',
                'payment_status' => 'Pending',
            ]);

            $amount = $order->total_cost;
            $currency = 'LKR';
            $hash = OnepayHelper::generateHash($currency, $amount);
            $reference = 'OMCORD_' . time();

            $response = Http::withHeaders([
                'Authorization' => config('onepay.api_key'),
            ])->post(config('onepay.base_url') . '/checkout/link/', [
                'currency' => $currency,
                'app_id' => config('onepay.app_id'),
                'hash' => $hash,
                'amount' => $amount,
                'reference' => $reference,
                'customer_first_name' => $order->customer_fname,
                'customer_last_name' => optional($order->user)->name ?? 'Unknown',
                'customer_phone_number' => $order->phone,
                'customer_email' => $order->email,
                'transaction_redirect_url' => config('app.url') . '/api/payment/callback',
                'additional_data' => $reference,
            ]);

            Log::info('OnePay Payment Response', [
                'status' => $response->status(),
                'body' => $response->json(),
            ]);

            if ($response->successful() && isset($response['data']['gateway']['redirect_url'])) {
                $redirectUrl = $response['data']['gateway']['redirect_url'];

                $order->update([
                    'payment_method' => 'Card',
                    'payment_status' => 'Pending',
                    'transaction_id' => $reference,
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Payment link generated successfully',
                    'data' => [
                        'payment_url' => $redirectUrl,
                        'transaction_id' => $reference,
                        'order_code' => $order->order_code,
                        'payment_method' => 'Card',
                        'payment_status' => 'Pending',
                        'total_cost' => round($amount, 2),
                    ]
                ]);
            }

            Log::error('OnePay payment failed or missing redirect URL', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Payment initiation failed. Please try again.'
            ], 400);

        } catch (\Exception $e) {
            Log::error('Error in initiateCardPayment', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to initiate payment. Please try again.'
            ], 500);
        }
    }

    /**
     * Check payment status
     */
    public function checkPaymentStatus($orderCode)
    {
        try {
            $order = CustomerOrder::where('order_code', $orderCode)
                ->where('user_id', Auth::id())
                ->first();

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'order_code' => $order->order_code,
                    'payment_status' => $order->payment_status ?? 'Not Paid',
                    'payment_method' => $order->payment_method,
                    'transaction_id' => $order->transaction_id,
                    'total_cost' => round($order->total_cost, 2),
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error checking payment status: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to check payment status'
            ], 500);
        }
    }

    /**
     * Handle payment callback (webhook)
     */
    public function handleCallback(Request $request)
    {
        Log::info('Payment callback received', ['request' => $request->all()]);

        try {
            $statusMessage = $request->input('status_message');
            $reference = $request->input('additional_data');

            $order = CustomerOrder::where('transaction_id', $reference)->first();

            if (!$order) {
                Log::error('Order not found for transaction reference: ' . $reference);
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found'
                ], 404);
            }

            if (strtoupper($statusMessage) === 'SUCCESS') {
                $order->update(['payment_status' => 'Paid']);
                Log::info('Order marked as Paid', ['order_code' => $order->order_code]);

                CartItem::where('user_id', $order->user_id)->delete();

                try {
                    $smsService = new DialogSMSService();
                    $vendorMobile = env('SMS_PHONE_NUMBER');
                    $message = "New Card Order Received:\nOrder Code: {$order->order_code}\nTotal: Rs. {$order->total_cost}";
                    $smsService->sendSMS($vendorMobile, $message);
                } catch (\Exception $e) {
                    Log::error('Failed to send SMS to vendor: ' . $e->getMessage());
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Payment confirmed and order updated'
                ]);
            } else {
                $order->update(['payment_status' => 'Failed']);
                Log::warning('Payment failed', ['status_message' => $statusMessage]);
                
                return response()->json([
                    'success' => false,
                    'message' => 'Payment was not successful'
                ], 400);
            }

        } catch (\Exception $e) {
            Log::error('Error handling payment callback', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing the payment'
            ], 500);
        }
    }

    /**
     * Get payment methods
     */
    public function getPaymentMethods()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'methods' => [
                    [
                        'id' => 'cod',
                        'name' => 'Cash on Delivery',
                        'description' => 'Pay when you receive your order',
                        'icon' => 'money',
                        'enabled' => true,
                    ],
                    [
                        'id' => 'card',
                        'name' => 'Credit/Debit Card',
                        'description' => 'Pay securely with your card',
                        'icon' => 'credit_card',
                        'enabled' => true,
                    ],
                ]
            ]
        ]);
    }
}
