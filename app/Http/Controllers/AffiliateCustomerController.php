<?php

namespace App\Http\Controllers;
use App\Models\Aff_Customer;
use App\Models\Affiliate_Customer;
use App\Models\Affiliate_User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\RaffleTicket;
use App\Models\Products;
use App\Models\AffiliateReferral;
use Illuminate\Support\Facades\Log;
use App\Models\PaymentRequest;


class AffiliateCustomerController extends Controller
{
    public function showAffCustomers()
    {
        $aff_customer =  Affiliate_User::all();
        return view('admin_dashboard.aff_customers', compact('aff_customer'));
    }


    public function showAffCustomerDetails($id)
    {
        $aff_customer = Affiliate_User::find($id);
    
        // Decode the promotion_method if it's a JSON string
        if ($aff_customer && is_string($aff_customer->promotion_method)) {
            $aff_customer->promotion_method = json_decode($aff_customer->promotion_method, true);
        }
    
        return view('admin_dashboard.aff_customer-details', compact('aff_customer'));
    }
    
    
    

    
    
    public function updateStatus(Request $request, $id)
    {
        $aff_customer = Affiliate_User::findOrFail($id);
        $aff_customer->status = $request->input('status');
        $aff_customer->save();
    
        return redirect()->back()->with('status', 'Customer status updated successfully.');
    }



    public function register(Request $request)
    {
        $request->merge([
            'dob_day' => (int) $request->dob_day,
            'dob_month' => (int) $request->dob_month,
            'dob_year' => (int) $request->dob_year,
        ]);
        
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'dob_day' => 'required|integer|min:1|max:31',
            'dob_month' => 'required|integer|min:1|max:12',
            'dob_year' => 'required|integer',
            'gender' => 'nullable|string|max:255',
            'NIC' => 'required|string|max:255',
            'phone_num' => 'required|string|max:20',
            'email' => 'required|email|unique:affiliate_users,email|max:255',
            'password' => 'required|string|min:8|confirmed',
            'promotion_method' => 'nullable|array',
            'instagram_url' => 'nullable|url',
            'facebook_url' => 'nullable|url',
            'tiktok_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'content_website_url' => 'nullable|url',
            'content_whatsapp_url' => 'nullable|url',
            'bank_name' => 'nullable|string|max:255',
            'branch' => 'nullable|string|max:255',
            'account_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:255',
        ]);

        // Combine the Date of Birth fields into a single date
        $dob = $validatedData['dob_year'] . '-' . str_pad($validatedData['dob_month'], 2, '0', STR_PAD_LEFT) . '-' . str_pad($validatedData['dob_day'], 2, '0', STR_PAD_LEFT);

        $customer = new Affiliate_User;
        $customer->name = $validatedData['name'];
        $customer->address = $validatedData['address'];
        $customer->district = $validatedData['district'];
        $customer->DOB = $dob;
        $customer->gender = $validatedData['gender'];
        $customer->NIC = $validatedData['NIC'];
        $customer->contactno = $validatedData['phone_num'];
        $customer->email = $validatedData['email'];
        $customer->password = $validatedData['password'];
        $customer->promotion_method = json_encode($validatedData['promotion_method'] ?? []); 
        $customer->instagram_url = $validatedData['instagram_url'];
        $customer->facebook_url = $validatedData['facebook_url'];
        $customer->tiktok_url = $validatedData['tiktok_url'];
        $customer->youtube_url = $validatedData['youtube_url'];
        $customer->content_website_url = $validatedData['content_website_url'];
        $customer->content_whatsapp_url = $validatedData['content_whatsapp_url'];
        $customer->bank_name = $validatedData['bank_name'];
        $customer->branch = $validatedData['branch'];
        $customer->account_name = $validatedData['account_name'];
        $customer->account_number = $validatedData['account_number'];
        $customer->status = 'pending';

        // Save the customer to the database
        $customer->save();

        // Redirect to a success page with a session message
        return redirect()->route('aff_home')->with('status', 'Affiliate account created successfully!');
    }

    


    
    public function login(Request $request)
    {
        //dd($request);
        // Validate the incoming request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8', 
        ]);

        $customer = Affiliate_User::where('email', $request->email)->first();

        if ($customer) {

            if ($customer->status === 'pending') {
                return redirect()->route('aff_home')->with('status1', 'pending');
            } elseif ($customer->status === 'rejected') {
                return redirect()->route('aff_home')->with('status1', 'rejected');
            } elseif ($customer->status === 'approved') {

                if (Hash::check($request->password, $customer->password)) {
                    Session::put('customer_id', $customer->id);
                    Session::put('customer_name', $customer->name);


                    return redirect()->route('index', ['affiliate_id' => $customer->id]);

                } else {
                    return redirect()->route('aff_home')->withErrors(['password' => 'Invalid credentials.']);
                }
            }
        } else {
            return redirect()->route('aff_home')->withErrors(['email' => 'Email not found.']);
        }
    }





    public function generatePromo(Request $request)
    {
        $trackingId = $request->input('tracking_id');
        $productId = $request->input('product_id');

        // Construct the product URL
        $productUrl = url("/product/$productId");

        // Construct the affiliate URL
        $affiliateUrl = url("/track/$trackingId/$productId?redirect=" . urlencode($productUrl));

        // Create the promo material message with the affiliate link
        $promoMaterial = "
            Top On Sale Product Recommendations!\n
            Product: Product Name\n
            Original price: LKR 1000\n
            Affiliate Link: $affiliateUrl
        ";

        // Store the promo material in the session (with the product ID)
        session()->flash('promo_material_' . $productId, $promoMaterial);

        // Redirect back to the view, so the modal gets updated with the new promo material
        return back();
    }



    
    
    

    public function index()
    {
        $affiliateId = Session::get('customer_id');
        $affiliateName = $affiliateId ? Affiliate_User::find($affiliateId)->name : 'Guest';

        // Get all referral records for the current affiliate
        $referrals = AffiliateReferral::where('user_id', $affiliateId)->get();

        // Calculate total referrals and total views
        $totalReferrals = $referrals->sum('referral_count');
        $totalViews = $referrals->sum('views_count');

        // Total Unpaid Earnings (set to 0 as per the original code)
        $totalUnpaidEarnings = 0;

        // Calculate total paid earnings
        $totalPaidEarnings = $referrals->sum('total_affiliate_price');

        // Calculate total paid amount for completed payment requests
        $completedPayments = PaymentRequest::where('user_id', $affiliateId)
        ->where('status', 'completed')
        ->sum('withdraw_amount');

        // Update totalPaidEarnings by subtracting completedPayments
        $totalPaidEarnings = max(0, $totalPaidEarnings - $completedPayments);

        // Calculate referrals over the last 12 months
        $referralsOverMonths = [];
        $months = [];

        for ($i = 11; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $monthName = $month->format('M');
            
            // Filter referrals by the specific month and user ID
            $monthlyReferrals = AffiliateReferral::where('user_id', $affiliateId)
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->sum('referral_count');
            
            $months[] = $monthName;
            $referralsOverMonths[] = $monthlyReferrals;
        }


        // Pass data to the view
        return view('affiliate_dashboard.index', compact(
            'affiliateName',
            'affiliateId',
            'totalReferrals',
            'totalViews',
            'totalUnpaidEarnings',
            'totalPaidEarnings',
            'referralsOverMonths', // Added for monthly chart data
            'months', // Added for x-axis labels in the chart
            'completedPayments'
        ));
    }


    

    public function logout(Request $request)
    {
        Session::forget('affiliate_customer_id');
        Session::forget('affiliate_customer_name');
        
        return redirect()->route('aff_home');
    }
    


}
