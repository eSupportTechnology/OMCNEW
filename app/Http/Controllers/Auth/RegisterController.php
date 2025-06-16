<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\DialogSMSService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the signup form.
     *
     * @return \Illuminate\View\View
     */
    public function showSignupForm()
    {
        return view('frontend.signup');
    }

    public function register(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'DOB' => 'required|date|before:today',
            'phone_num' => 'required|string|max:16|regex:/^\+?[0-9]{7,15}$/',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Store user data in the database
        $user = new User();
        $user->name = $validatedData['name'];;
        $user->address = $validatedData['address'];
        $user->district = $validatedData['district'];
        $user->date_of_birth = $validatedData['DOB'];
        $user->phone_num = $validatedData['phone_num'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->save();

        // ✅ Send SMS to vendor
        try {
            $smsService = new DialogSMSService();
            $vendorMobile = env('SMS_PHONE_NUMBER'); // Change this to your vendor's actual mobile number
            $message = "New User is registed:\nUser Name: {$user->name}\nEmail: Rs. {$user->email}";

            $smsService->sendSMS($vendorMobile, $message);
        } catch (\Exception $e) {
            Log::error('Failed to send SMS to vendor: ' . $e->getMessage());
        }

        // Redirect to a success page or login
        return redirect()->route('login')->with('success', 'Account created successfully! You can now log in.');
    }
}
