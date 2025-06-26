<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Affiliate_User;

class AffiliateDashboardController extends Controller
{

    public function index()
    {
        $affiliateId = Session::get('customer_id');
        $customer = Affiliate_User::where('id', $affiliateId)->first();

        if ($customer) {
            if (is_string($customer->promotion_method)) {
                $customer->promotion_method = json_decode($customer->promotion_method, true);
            }

            $customer->promotion_method = $customer->promotion_method ?? [];
        }

        return view('affiliate_dashboard.mywebsites_page', compact('customer'));
    }


    public function updateBasicInfo(Request $request)
    {
        $affiliateId = Session::get('customer_id');
        $customer = Affiliate_User::where('id', $affiliateId)->first();

        if ($customer) {
            $customer->name = $request->input('payeename');
            $customer->email = $request->input('loginemail');
            $customer->contactno = $request->input('loginphone');
            $customer->save();
        }

        return redirect()->back()->with('success', 'Basic information updated successfully.');
    }

    public function updateBankInfo(Request $request)
{
    $request->validate([
        'bank_name' => 'nullable|string|max:255',
        'branch' => 'nullable|string|max:255',
        'account_name' => 'nullable|string|max:255',
        'account_number' => 'nullable|string|max:255',
    ]);

     $affiliateId = Session::get('customer_id');
        $customer = Affiliate_User::where('id', $affiliateId)->first();
    $customer->update([
        'bank_name' => $request->bank_name,
        'branch' => $request->branch,
        'account_name' => $request->account_name,
        'account_number' => $request->account_number,
    ]);

    return redirect()->back()->with('status', 'Bank Information updated successfully.');
}





    public function updateSiteInfo(Request $request)
    {
        $request->validate([
            'promotion_methods' => 'nullable|array',
            'instagram_url' => 'nullable|url',
            'facebook_url' => 'nullable|url',
            'tiktok_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'content_website_url' => 'nullable|url',
            'content_whatsapp_url' => 'nullable|url',
        ]);

        
        $affiliateId = Session::get('customer_id');
        $customer = Affiliate_User::where('id', $affiliateId)->first();

        if ($customer) {
            $selectedMethods = $request->promotion_methods ?? [];
            $customer->promotion_method = json_encode($selectedMethods);

            $customer->instagram_url = in_array('Instagram', $selectedMethods) ? $request->instagram_url : null;
            $customer->facebook_url = in_array('Facebook', $selectedMethods) ? $request->facebook_url : null;
            $customer->tiktok_url = in_array('TikTok', $selectedMethods) ? $request->tiktok_url : null;
            $customer->youtube_url = in_array('YouTube', $selectedMethods) ? $request->youtube_url : null;
            $customer->content_website_url = in_array('Content website/blog', $selectedMethods) ? $request->content_website_url : null;
            $customer->content_whatsapp_url = in_array('WhatsApp', $selectedMethods) ? $request->whatsapp_url : null;


            $customer->save();

            return redirect()->back()->with('success', 'Site information updated successfully.');
        }

        return redirect()->back()->with('error', 'Unable to update site information.');
    }



   
    

}
