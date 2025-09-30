<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerOrder;
use App\Models\ReturnRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReturnRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $userId = Auth::id();

        $orders = CustomerOrder::where('user_id', $userId)
            ->where('status', 'Delivered')
            ->get();

        return view('frontend.ReturnProduct', compact('orders'));
    }

    public function store(Request $request)
    {
        Log::info('Store method hit', $request->all());

        $request->validate([
            'order_id' => 'required|exists:customer_order,id',
            'billing_last_name' => 'required',
            'email' => 'required|email',
            'reason' => 'nullable|string|max:500',
        ]);


        $userId = Auth::id();

        $order = CustomerOrder::where('id', $request->order_id)
            ->where('user_id', Auth::id())
            ->where('status', 'Delivered')
            ->first();

        if (!$order) {
            return back()->withErrors(['order_code' => 'Invalid order ID or this order does not belong to you, or it is not delivered yet.']);
        }

        $existingRequest = ReturnRequest::where('user_id', $userId)
            ->where('order_id', $order->id)
            ->first();

        if ($existingRequest) {
            return back()->with('error', 'You have already submitted a return request for this order.');
        }

        try {
            ReturnRequest::create([
                'order_id' => $order->id,
                'user_id' => $order->user_id,
                'billing_last_name' => $request->billing_last_name,
                'email' => $request->email,
                'reason' => $request->reason ?? 'No reason provided',
                'status' => 'pending',
            ]);
            Log::info('Return request inserted successfully');
        } catch (\Exception $e) {
            Log::error('Return request failed: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong while submitting the request.');
        }

        return back()->with('success', 'Return request submitted successfully!');
    }
}
