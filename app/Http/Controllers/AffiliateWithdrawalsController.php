<?php

namespace App\Http\Controllers;

use App\Models\PaymentRequest;
use Illuminate\Http\Request;

class AffiliateWithdrawalsController extends Controller
{
    public function index()
    {
      
        $pendingRequests = PaymentRequest::where('status', 'Pending')->with('affiliateUser')->get();
        $pendingCount = $pendingRequests->count();
        $completedRequests = PaymentRequest::where('status', 'Completed')->with('affiliateUser')->get();

        return view('admin_dashboard.affiliate_withdrawals', compact('pendingRequests', 'completedRequests'));
    }


    public function updatePaymentStatus(Request $request, $id)
    {
  
        $request->validate([
            'processing_fee' => 'required|numeric|min:0',
            'paid_amount' => 'required|numeric|min:0',
        ]);

        $paymentRequest = PaymentRequest::findOrFail($id);

        $paymentRequest->processing_fee = $request->processing_fee;
        $paymentRequest->paid_amount = $request->paid_amount;
        $paymentRequest->status = 'Completed';
        $paymentRequest->save();

        return redirect()->route('affiliate_withdrawals')->with('status', 'Payment status updated successfully.');
    }
}
