<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        try {
            $request->validate([
                'first_name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'email' => 'required|email|max:255',
                'address' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'postal_code' => 'required|string|max:10',
                'company_name' => 'nullable|string|max:255',
                'apartment' => 'nullable|string|max:255',
                'tracking_id' => 'nullable|string',
                'shipping_fee' => 'nullable|numeric|min:0',
            ]);

            $cart = CartItem::where('user_id', Auth::id())
                ->with(['product.sale', 'product.specialOffer', 'product.variations'])
                ->get();
            
            if ($cart->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Your cart is empty. Add some items to proceed.'
                ], 400);
            }

            $cartArray = $cart->map(function ($item) {
                $price = $this->calculateProductPrice($item->product);
                
                return [
                    'product_id' => $item->product_id,
                    'price' => $price,
                    'quantity' => $item->quantity,
                    'size' => $item->size,
                    'color' => $item->color,
                    'material' => $item->material,
                ];
            })->toArray();

            $subtotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cartArray));
            $shipping = $request->input('shipping_fee', 0);
            $total = $subtotal + $shipping;

            $orderCode = 'ORD-' . strtoupper(substr((string) Str::uuid(), 0, 8));

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
                'delivery_fee' => $shipping,  // ✅ SAVE SHIPPING FEE
                'discount' => 0,
                'user_id' => Auth::id(),
                'status' => 'Confirmed',
                'payment_status' => 'Pending',
            ];

            DB::beginTransaction();

            $order = CustomerOrder::create($orderData);

            foreach ($cartArray as $item) {
                if ($request->tracking_id) {
                    $this->trackReferral($request->tracking_id, $item['product_id']);
                }

                CustomerOrderItems::create([
                    'order_code' => $orderCode,
                    'product_id' => $item['product_id'],
                    'date' => Carbon::now()->format('Y-m-d'),
                    'cost' => $item['price'],
                    'quantity' => $item['quantity'],
                    'size' => $item['size'],
                    'color' => $item['color'],
                    'material' => $item['material'],
                ]);

                $this->updateProductQuantities($item);
            }

            CartItem::where('user_id', Auth::id())->delete();

            DB::commit();

            Log::info('Order created successfully', [
                'order_code' => $orderCode,
                'user_id' => Auth::id(),
                'subtotal' => $subtotal,
                'shipping' => $shipping,
                'total' => $total,
                'items_count' => count($cartArray)
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Order created successfully',
                'data' => [
                    'order_code' => $orderCode,
                    'total_cost' => $total,
                    'subtotal' => $subtotal,
                    'shipping' => $shipping,
                    'order_id' => $order->id
                ]
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating order from cart', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your order. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function buyNowOrder(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required|exists:products,product_id',
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
                'material' => 'nullable|string|max:255',
                'quantity' => 'required|integer|min:1',
                'tracking_id' => 'nullable|string',
                'shipping_fee' => 'nullable|numeric|min:0',
            ]);

            $product = Products::with(['sale', 'specialOffer', 'variations'])
                ->where('product_id', $request->product_id)
                ->first();

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found'
                ], 404);
            }

            $quantity = $request->input('quantity', 1);
            $price = $this->calculateProductPrice($product);

            $subtotal = $price * $quantity;
            $shipping = $request->input('shipping_fee', 0);
            $total = $subtotal + $shipping;

            $orderCode = 'ORD-' . strtoupper(substr((string) Str::uuid(), 0, 8));

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
                'delivery_fee' => $shipping,  // ✅ SAVE SHIPPING FEE
                'discount' => 0,
                'user_id' => Auth::id(),
                'status' => 'Confirmed',
                'payment_status' => 'Pending',
            ];

            DB::beginTransaction();

            $order = CustomerOrder::create($orderData);

            CustomerOrderItems::create([
                'order_code' => $orderCode,
                'product_id' => $product->product_id,
                'date' => Carbon::now()->format('Y-m-d'),
                'cost' => $price,
                'quantity' => $quantity,
                'size' => $request->input('size'),
                'color' => $request->input('color'),
                'material' => $request->input('material'),
            ]);

            $this->updateProductQuantities([
                'product_id' => $product->product_id,
                'quantity' => $quantity,
                'size' => $request->input('size'),
                'color' => $request->input('color'),
                'material' => $request->input('material'),
            ]);

            if ($request->tracking_id) {
                $this->trackReferral($request->tracking_id, $product->product_id);
            }

            DB::commit();

            Log::info('Buy now order created', [
                'order_code' => $orderCode,
                'product_id' => $product->product_id,
                'quantity' => $quantity,
                'shipping' => $shipping,
                'total' => $total
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Order created successfully',
                'data' => [
                    'order_code' => $orderCode,
                    'total_cost' => $total,
                    'subtotal' => $subtotal,
                    'shipping' => $shipping,
                    'order_id' => $order->id
                ]
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating buy now order', [
                'error' => $e->getMessage(),
                'product_id' => $request->product_id ?? null
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your order. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getOrders(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 10);
            $status = $request->get('status');
            
            $query = CustomerOrder::where('user_id', Auth::id())
                ->with(['items.product.images'])
                ->orderBy('created_at', 'desc');
            
            if ($status && $status !== 'all') {
                $query->where('status', ucfirst($status));
            }
            
            $orders = $query->paginate($perPage);
            
            $transformedOrders = $orders->getCollection()->map(function($order) {
                $orderArray = $order->toArray();
                $orderArray['order_items'] = $orderArray['items'] ?? [];
                unset($orderArray['items']);
                return $orderArray;
            });
            
            return response()->json([
                'success' => true,
                'data' => [
                    'data' => $transformedOrders,
                    'current_page' => $orders->currentPage(),
                    'last_page' => $orders->lastPage(),
                    'per_page' => $orders->perPage(),
                    'total' => $orders->total(),
                    'from' => $orders->firstItem(),
                    'to' => $orders->lastItem(),
                ]
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error fetching orders', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Error fetching orders',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getOrder($orderCode)
    {
        try {
            $order = CustomerOrder::where('order_code', $orderCode)
                ->where('user_id', Auth::id())
                ->with(['items.product.images'])
                ->first();

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found'
                ], 404);
            }

            $orderArray = $order->toArray();
            $orderArray['order_items'] = $orderArray['items'] ?? [];
            unset($orderArray['items']);

            return response()->json([
                'success' => true,
                'data' => $orderArray
            ]);

        } catch (\Exception $e) {
            Log::error('Error fetching order', [
                'error' => $e->getMessage(),
                'order_code' => $orderCode
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Error fetching order details',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function calculateProductPrice($product)
    {
        if ($product->sale && $product->sale->status === 'active') {
            return $product->sale->sale_price;
        }
        
        if ($product->specialOffer && $product->specialOffer->status === 'active') {
            return $product->specialOffer->offer_price;
        }
        
        return $product->normal_price;
    }

    private function trackReferral($tracking_id, $product_id)
    {
        $raffleTicket = RaffleTicket::where('token', $tracking_id)->first();

        if ($raffleTicket) {
            $referral = AffiliateReferral::where('raffle_ticket_id', $raffleTicket->id)
                ->where('product_url', 'like', '%' . $product_id . '%')
                ->first();

            if ($referral) {
                $product = Products::where('product_id', $product_id)->first();

                if ($product && $product->affiliate_price) {
                    $referral->increment('referral_count');
                    $referral->total_affiliate_price += $referral->affiliate_commission;
                    $referral->save();
                    
                    Log::info("Affiliate referral tracked", [
                        'tracking_id' => $tracking_id,
                        'product_id' => $product_id
                    ]);
                }
            }
        }
    }

    private function updateProductQuantities($item)
    {
        $product = Products::where('product_id', $item['product_id'])->first();
        if ($product) {
            $product->quantity -= $item['quantity'];
            $product->save();
        }

        if (!empty($item['size'])) {
            Variation::where('product_id', $item['product_id'])
                ->where('type', 'Size')
                ->where('value', $item['size'])
                ->decrement('quantity', $item['quantity']);
        }

        if (!empty($item['color'])) {
            Variation::where('product_id', $item['product_id'])
                ->where('type', 'Color')
                ->where('value', $item['color'])
                ->decrement('quantity', $item['quantity']);
        }

        if (!empty($item['material'])) {
            Variation::where('product_id', $item['product_id'])
                ->where('type', 'Material')
                ->where('value', $item['material'])
                ->decrement('quantity', $item['quantity']);
        }
    }
}
