<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RaffleTicket;
use App\Models\AffiliateReferral;
use App\Models\AffiliateLink;
use App\Models\Products;
use App\Models\AffiliateProduct;
use Illuminate\Support\Facades\Session;


class AffiliateLinkController extends Controller
{
    public function showAffiliateForm()
    {
        $customerId = Session::get('customer_id');

        // Get all tracking IDs (raffle tickets) for the logged-in user
        $trackingIds = RaffleTicket::where('user_id', $customerId)->get();

        // Check if there's already an "Active" tracking ID (default equivalent)
        $defaultTrackingId = $trackingIds->where('status', 'Pending')->first();

        // If no "Active" tracking ID is set and the user has at least one tracking ID, set the first one as "Active"
        if (!$defaultTrackingId && $trackingIds->count() == 1) {
            $defaultTrackingId = $trackingIds->first(); // Set the first ID as the default for this session
            $defaultTrackingId->status = 'Pending'; // Mark it as Active (default equivalent)
            $defaultTrackingId->save(); // Save to the database
        }

        return view('affiliate_dashboard.tool', compact('trackingIds', 'defaultTrackingId'));
    }







    public function generateNewLink(Request $request)
    {
        // Validate the input
        $request->validate([
            'product_url' => 'required|url',
            'tracking_id' => 'required|string'
        ]);

        // Extract the product identifier (e.g., product_id or product_name) from the URL
        $productIdentifier = basename($request->product_url); // This extracts the last part of the URL (e.g., PRODUCT-XXXXX)

        //dd($productIdentifier);
        // Find the product by product_id or product_name
        $product = Products::where('product_id', $productIdentifier)->orWhere('product_name', $productIdentifier)->first();

        // If product exists, continue
        if ($product) {
            // Generate the affiliate tracking link
            //$trackingUrl = url('/track/' . $request->tracking_id) . '?redirect=' . urlencode($request->product_url);
            $trackingUrl = url('/track/' . $request->tracking_id . '/' . $product->product_id) . '?redirect=' . urlencode($request->product_url);


            // Find the raffle ticket by the tracking ID
            $raffleTicket = RaffleTicket::where('token', $request->tracking_id)->first();



            if ($raffleTicket) {
                // Save the generated link to the affiliate_links table
                $affiliateLink = AffiliateLink::create([
                    'user_id' => $raffleTicket->user_id,
                    'raffle_ticket_id' => $raffleTicket->id,
                    'link' => $trackingUrl,
                ]);

                // Save product details and other referral data in the AffiliateReferral table
                AffiliateReferral::create([
                    'user_id' => $raffleTicket->user_id,
                    'raffle_ticket_id' => $raffleTicket->id,
                    'product_url' => $request->product_url,
                    'views_count' => 0,
                    'referral_count' => 0,
                    'product_price' => $product->total_price,
                    'affiliate_commission' => $this->calculateCommission($product->affiliate_price),
                    'total_affiliate_price' => 0,
                ]);
                //                 AffiliateReferral::create([
                //     'user_id' => $raffleTicket->user_id,
                //     'raffle_ticket_id' => $raffleTicket->id,
                //     'product_url' => $request->product_url,
                //     'views_count' => 0,
                //     'referral_count' => 0,
                //     'product_price' => $product->affiliate_price ?? $product->normal_price, 
                //     'affiliate_commission' => ($product->commission_percentage / 100) * ($product->affiliate_price ?? 0),
                //     'total_affiliate_price' => 0,
                // ]);


                // Link the product and the affiliate link
                AffiliateProduct::create([
                    'product_id' => $product->id,
                    'affiliate_link_id' => $affiliateLink->id,
                ]);

                // Redirect back to the form with the generated link
                return redirect()->back()->with('generated_link', $trackingUrl);
            }
        }

        // If no product or raffle ticket is found, return an error
        return redirect()->back()->withErrors('Invalid tracking ID or product URL');
    }

    public function calculateCommission($affiliatePrice)
    {
        // Assuming the product has a commission percentage field, and it is stored as a decimal value (e.g., 0.10 for 10%)
        // Fetch the commission percentage from the product
        $product = Products::where('affiliate_price', $affiliatePrice)->first();

        // Ensure the product has a valid commission percentage
        if ($product && $product->commission_percentage > 0) {
            // Calculate the commission as a percentage of the affiliate price
            $commission = ($product->commission_percentage / 100) * $affiliatePrice;

            // Return the calculated commission
            return $commission;
        }

        // If no valid commission percentage is found, return 0
        return 0;
    }


    public function trackClick(Request $request, $tracking_id, $product_id)
    {
        // Find the raffle ticket by the tracking ID
        $raffleTicket = RaffleTicket::where('token', $tracking_id)->first();

        if ($raffleTicket) {
            // Find the specific referral record by raffle_ticket_id and product_id
            $referral = AffiliateReferral::where('raffle_ticket_id', $raffleTicket->id)
                ->where('product_url', 'like', '%' . $product_id . '%')
                ->first();

            if ($referral) {
                // Increment the views count for the specific product referral
                $referral->increment('views_count');

                // Store tracking_id in the session for later use during the checkout process
                session(['tracking_id' => $tracking_id]);

                // Check if a redirect URL is provided
                if ($request->has('redirect')) {
                    return redirect($request->input('redirect'));
                }

                // Default redirect if no redirect URL is provided
                return redirect('/');
            }
        }

        // If not found, redirect to home or show an error
        return redirect('/')->withErrors('Invalid tracking link.');
    }







    public function adCenter()
    {
        $customerId = Session::get('customer_id');

        $affliatelinks = AffiliateLink::with(['raffleTicket.product.images']) // Load product and its images
            ->where('user_id', $customerId)
            ->get();

        return view('affiliate_dashboard.code_center', compact('affliatelinks'));
    }


    public function codeCenter()
    {
        // Get the customer ID from session
        $customerId = Session::get('customer_id');

        // Find all affiliate links for the customer
        $affiliateLinks = AffiliateLink::with(['raffleTicket', 'product'])
            ->where('user_id', $customerId)
            ->get();

        // Pass data to the view
        return view('affiliate_dashboard.code_center', compact('affiliateLinks'));
    }
}
