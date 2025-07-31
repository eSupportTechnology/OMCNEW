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
use Illuminate\Support\Facades\Mail;
use App\Mail\SendVerificationCode;

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
        // 1. Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'DOB' => 'required|date|before:today',
            'phone_num' => 'required|string|max:16|regex:/^\+?[0-9]{7,15}$/',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // 2. Generate separate OTPs
        $emailOtp = rand(100000, 999999);
        $smsOtp = rand(100000, 999999);

        // 3. Store user data (use email OTP or store both in separate fields if needed)
        $user = new User();
        $user->name = $validatedData['name'];
        $user->address = $validatedData['address'];
        $user->district = $validatedData['district'];
        $user->date_of_birth = $validatedData['DOB'];
        $user->phone_num = $validatedData['phone_num'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->verification_code = $emailOtp; // storing email OTP
        $user->sms_code = $smsOtp; // storing SMS OTP
        $user->is_verified = false;
        $user->save();

        // 4. Send verification email
        Mail::to($user->email)->send(new SendVerificationCode($emailOtp));
        session(['email' => $user->email]);
        Log::info("📧 Email OTP sent | Email: {$user->email} | Code: {$emailOtp}");

        // 5. Send SMS OTP (but not stored)
        try {
            session(['phone' => $user->phone_num]);
            $smsService = new DialogSMSService();
            $smsMessage = "Your SMS verification code is: {$smsOtp}";
            $smsService->sendSMS($user->phone_num, $smsMessage);

            Log::info("📱 SMS OTP sent | Phone: {$user->phone_num} | Code: {$smsOtp}");
        } catch (\Exception $e) {
            Log::warning("⚠️ SMS OTP FAILED | Phone: {$user->phone_num} | Code: {$smsOtp}");
            Log::error('❌ SMS sending error: ' . $e->getMessage());
        }


        return redirect()->route('verify.form')->with('email', $user->email);
    }



    public function showVerificationForm()
    {
        return view('auth.codeverify'); // create this blade below
    }
    public function showSmsVerificationForm()
    {
        return view('auth.smscodeverify'); // create this blade below
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|digits:6',
        ]);

        $user = User::where('email', $request->email)
            ->where('verification_code', $request->code)
            ->first();

        if (!$user) {
            return back()->withErrors(['code' => 'Invalid verification code']);
        }

        return redirect()->route('sms-verify.form')->with('success', 'Email verified! You can now login.');
    }

    public function smsverifyCode(Request $request)
    {
        // dd($request->all());
        // Validate input
        $request->validate([
            'phone' => 'required|string|regex:/^\+?[0-9]{7,15}$/',
            'code' => 'required|digits:6',
        ]);

        // Find user by phone number and verification code
        $user = User::where('phone_num', $request->phone)
            ->where('sms_code', $request->code)
            ->first();

        if (!$user) {
            Log::warning('User not found or code mismatch', ['phone' => $request->phone, 'code' => $request->code]);
            return back()->withErrors(['code' => 'Invalid or expired sms code.']);
        }
        Log::info('User verified', ['user_id' => $user->id]);


        // Update user as verified
        $user->is_verified = true;
        $user->sms_code = null; // optional, clears OTP
        $user->save();

        return redirect()->route('login')->with('success', 'SMS verified! You can now log in.');
    }
}
