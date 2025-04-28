<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InquiryController extends Controller
{
    public function store(Request $request)
    {
        // chek User log
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Please register and log in to submit an inquiry.');
        }

        // Validate the form data
        $request->validate([
            'order_id' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        //  save Inquiry 
        Inquiry::create([
            'user_id' => Auth::id(), // Current Logged in User ID
            'order_id' => $request->order_id,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);


        return redirect()->back()->with('status', 'Your inquiry has been submitted successfully.');
    }



   public function showCustomerInquiries() 
   {
    $inquiries = Inquiry::with('user')->get(); 
    return view('admin_dashboard.customer_inquiries', compact('inquiries'));
    }




    public function submitResponse(Request $request, $id)
    {
        $request->validate([
            'response' => 'required|string|max:1000', 
        ]);

        $inquiry = Inquiry::findOrFail($id);
        $inquiry->reply = $request->response; 
        $inquiry->status = 'replied'; 
        $inquiry->save();

        return redirect()->route('customer_inquiries')->with('status', 'Response submitted successfully.');
    }



}
