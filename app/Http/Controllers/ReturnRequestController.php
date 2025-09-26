<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerOrder;
use App\Models\ReturnRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReturnRequestController extends Controller
{
    public function create()
    {
        return view('frontend.ReturnProduct');
    }

    public function store(Request $request)
    {
        Log::info('Store method hit', $request->all());

        $request->validate([
            'order_code' => 'required|exists:customer_order,order_code',
            'email' => 'required|email',
            'billing_last_name' => 'required',
            'reason' => 'nullable|string|max:500',
        ]);

        $order = CustomerOrder::where('order_code', $request->order_code)
            ->where('status', 'delivered')
            ->first();

        if (!$order) {
            return back()->withErrors(['order_code' => 'Order not found or not delivered yet.']);
        }

        Log::info('Creating return request', [
            'order_id' => $order->id,
            'user_id' => $order->user_id,
            'reason' => $request->reason ?? 'No reason provided',
            'status' => 'pending',
        ]);

        try {
            ReturnRequest::create([
                'order_id' => $order->id,
                'user_id' => $order->user_id,
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
