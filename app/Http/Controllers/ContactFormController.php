<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactFormController extends Controller
{
    public function send_contact_mail(Request $request) {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Save the data to the database
        ContactMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        // Send the email
        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new ContactFormMail($request));

        return back()->with('success', 'Thank you for contacting us!');
    }
}
