<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RaffleTicket;
use App\Models\AffiliateReferral;
use App\Models\Products;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Affiliate_User;
use App\Models\PaymentRequest;


class AffiliateReportController extends Controller
{
    public function report($id)
    {
        // Find the raffle ticket by ID
        $raffleTicket = RaffleTicket::findOrFail($id);

        return view('affiliate_dashboard.order_tracking', compact('raffleTicket'));
    }


    public function trafficreport(Request $request)
    {
        // Get the customer_id from session
        $customerId = Session::get('customer_id');

        // If customer_id is not found in session, handle the error or redirect
        if (!$customerId) {
            return redirect()->back()->with('error', 'Customer not found.');
        }

        // Fetch all raffle tickets for the current user to show in the dropdown
        $raffleTickets = RaffleTicket::where('user_id', $customerId)->get();

        // Initialize the query for AffiliateReferral
        $query = AffiliateReferral::where('user_id', $customerId)->with(['raffleTicket']);

        // Apply filter if a specific raffle ticket is selected
        if ($request->has('raffle_ticket_id') && $request->raffle_ticket_id) {
            $query->where('raffle_ticket_id', $request->raffle_ticket_id);
        }

        // Fetch the filtered or unfiltered results
        $affiliateReferrals = $query->get();

        // Loop through each referral and extract the product_id from the product_url
        foreach ($affiliateReferrals as $referral) {
            // Extract the product ID from the URL
            $productIdentifier = basename($referral->product_url); // This gets the last part of the URL (e.g., PRODUCT-XXXXX)

            // Query the Products model to find the product by product_id or product_name
            $product = Products::where('product_id', $productIdentifier)
                ->orWhere('product_name', $productIdentifier)
                ->first();

            // Attach the product name to the referral object for use in the view
            if ($product) {
                $referral->product_name = $product->product_name;
            } else {
                $referral->product_name = 'N/A'; // Fallback if the product isn't found
            }
        }

        // Pass the raffle tickets and affiliate referrals to the view
        return view('affiliate_dashboard.traffic_report', compact('affiliateReferrals', 'raffleTickets'));
    }



    public function withdrawals()
    {

        $affiliateId = Session::get('customer_id');
        $affiliateName = $affiliateId ? Affiliate_User::find($affiliateId)->name : 'Guest';

        // Get all referral records for the current affiliate
        $referrals = AffiliateReferral::where('user_id', $affiliateId)->get();

        // Calculate total paid earnings
        $totalBalance = $referrals->sum('total_affiliate_price');

        // Calculate total paid amount for completed payment requests
        $completedPayments = PaymentRequest::where('user_id', $affiliateId)
        ->where('status', 'completed')
        ->sum('withdraw_amount');

        // Update totalPaidEarnings by subtracting completedPayments
        $totalBalance = max(0, $totalBalance - $completedPayments);


        $customerId = Session::get('customer_id');
        $paymentRequests = PaymentRequest::where('user_id', $customerId)->get();

        return view('affiliate_dashboard.withdrawals', compact('totalBalance','paymentRequests'));
    }

    public function showPaymentInfo()
    {
        // Assuming the user is authenticated and you are using the Auth system
        $customerId = Session::get('customer_id'); // Get the logged-in user's ID

        // Fetch the payment details from the Affiliate_Customer model
        $customer = Affiliate_User::where('id', $customerId)->first();
        

        // Pass the customer payment details to the view
        return view('affiliate_dashboard.payment_info', compact('customer'));
    }


    public function realtimereport(Request $request)
    {
        // Get the customer_id from session
        $customerId = Session::get('customer_id');

        // If customer_id is not found in session, handle the error or redirect
        if (!$customerId) {
            return redirect()->back()->with('error', 'Customer not found.');
        }

        // Check if tracking ID (raffle_ticket_id) is provided
        if (!$request->has('raffle_ticket_id')) {
            return redirect()->back()->with('error', 'No tracking ID provided.');
        }

        // Fetch all raffle tickets for the current user (optional for other use cases)
        $raffleTickets = RaffleTicket::where('user_id', $customerId)->get();

        // Fetch the traffic data for the given raffle_ticket_id
        $raffleTicketId = $request->raffle_ticket_id;
        $affiliateReferrals = AffiliateReferral::where('user_id', $customerId)
            ->where('raffle_ticket_id', $raffleTicketId)
            ->with('raffleTicket')
            ->get();

        // Loop through each referral and extract the product_id from the product_url
        foreach ($affiliateReferrals as $referral) {
            // Extract the product ID from the URL
            $productIdentifier = basename($referral->product_url); // This gets the last part of the URL (e.g., PRODUCT-XXXXX)

            // Query the Products model to find the product by product_id or product_name
            $product = Products::where('product_id', $productIdentifier)
                ->orWhere('product_name', $productIdentifier)
                ->first();

            // Attach the product name to the referral object for use in the view
            $referral->product_name = $product ? $product->product_name : 'N/A';
        }

        // Pass the affiliate referrals and raffle ticket data to the view
        return view('affiliate_dashboard.order_tracking', compact('affiliateReferrals', 'raffleTickets', 'raffleTicketId'));
    }








}
