<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\DialogSMSService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\SendVerificationCode;
use Carbon\Carbon;

class AuthController extends Controller
{
    /**
     * Register a new user with dual verification (Email + SMS)
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'date_of_birth' => 'required|date|before:today',
            'gender' => 'nullable|in:male,female,other',
            'phone_num' => 'required|string|max:16|regex:/^\+?[0-9]{7,15}$/|unique:users,phone_num',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Generate separate OTPs for email and SMS
            $emailOtp = rand(100000, 999999);
            $smsOtp = rand(100000, 999999);
            
            // Handle profile image upload
            $profileImagePath = null;
            if ($request->hasFile('profile_image')) {
                $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
            }

            // Create user using fillable attributes
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password, // Will be hashed automatically due to cast
                'address' => $request->address,
                'district' => $request->district,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'phone_num' => $request->phone_num,
                'profile_image' => $profileImagePath,
                'role' => 'customer', // Default role
                'status' => 'active', // Default status
            ]);

            // Set verification codes (not in fillable, so set separately)
            $user->verification_code = $emailOtp; // Email OTP
            $user->sms_code = $smsOtp; // SMS OTP
            $user->is_verified = false; // SMS verification status
            $user->is_email_verified = false; // Email verification status
            $user->save();

            // Send email verification code
            Mail::to($user->email)->send(new SendVerificationCode($emailOtp));
            Log::info("📧 Email OTP sent | Email: {$user->email} | Code: {$emailOtp}");

            // Send SMS OTP to user
            try {
                $smsService = new DialogSMSService();
                $smsMessage = "Your SMS verification code is: {$smsOtp}";
                $smsService->sendSMS($user->phone_num, $smsMessage);
                Log::info("📱 SMS OTP sent | Phone: {$user->phone_num} | Code: {$smsOtp}");
            } catch (\Exception $e) {
                Log::warning("⚠️ SMS OTP FAILED | Phone: {$user->phone_num} | Code: {$smsOtp}");
                Log::error('❌ SMS sending error: ' . $e->getMessage());
            }

            // Send SMS notification to vendor
            try {
                $smsService = new DialogSMSService();
                $vendorMobile = env('SMS_PHONE_NUMBER');
                $message = "New User registered:\nUser Name: {$user->name}\nEmail: {$user->email}";
                $smsService->sendSMS($vendorMobile, $message);
            } catch (\Exception $e) {
                Log::error('Failed to send SMS to vendor: ' . $e->getMessage());
            }

            return response()->json([
                'success' => true,
                'message' => 'User registered successfully. Please verify your email and phone number.',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'phone_num' => $user->phone_num,
                        'profile_image_url' => $user->profile_image_url,
                    ],
                    'verification_required' => true,
                    'email_verification_required' => true,
                    'sms_verification_required' => true
                ]
            ], 201);

        } catch (\Exception $e) {
            Log::error('Registration failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Registration failed. Please try again.'
            ], 500);
        }
    }

    /**
     * Login user with dual verification check
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.'
            ], 404);
        }

        // Check email verification status
        if ($user->is_email_verified == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Your account is not verified. Please check your email for verification instructions.',
                'email_verification_required' => true,
                'email' => $user->email
            ], 403);
        }

        // Check SMS verification status
        if ($user->is_verified == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Your account is not verified. Please check your SMS for verification instructions.',
                'sms_verification_required' => true,
                'phone' => $user->phone_num
            ], 403);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Update last login timestamp
            $user->update(['last_login' => Carbon::now()]);

            // Create token
            $token = $user->createToken('mobile_app_token')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'phone_num' => $user->phone_num,
                        'address' => $user->address,
                        'district' => $user->district,
                        'date_of_birth' => $user->date_of_birth,
                        'gender' => $user->gender,
                        'profile_image_url' => $user->profile_image_url,
                        'role' => $user->role,
                        'status' => $user->status,
                        'last_login' => $user->last_login,
                    ],
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                ]
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'The provided credentials do not match our records.'
        ], 401);
    }

    /**
     * Verify email code (Step 1 of 2)
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyEmailCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'code' => 'required|digits:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::where('email', $request->email)
                    ->where('verification_code', $request->code)
                    ->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid verification code'
            ], 400);
        }

        // Only set email as verified
        $user->is_email_verified = true;
        $user->verification_code = null;
        $user->save();

        Log::info("✅ Email verified | User: {$user->email}");

        return response()->json([
            'success' => true,
            'message' => 'Email verified successfully! Please verify your phone number.',
            'data' => [
                'user_id' => $user->id,
                'email' => $user->email,
                'phone_num' => $user->phone_num,
                'email_verified' => true,
                'sms_verification_required' => true
            ]
        ], 200);
    }

    /**
     * Verify SMS code (Step 2 of 2)
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifySmsCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string|regex:/^\+?[0-9]{7,15}$/',
            'code' => 'required|digits:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::where('phone_num', $request->phone)
                    ->where('sms_code', $request->code)
                    ->first();

        if (!$user) {
            Log::warning('User not found or code mismatch', ['phone' => $request->phone, 'code' => $request->code]);
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired SMS code.'
            ], 400);
        }

        // Check if email is verified first
        if (!$user->is_email_verified) {
            return response()->json([
                'success' => false,
                'message' => 'Please verify your email first before verifying SMS.'
            ], 400);
        }

        Log::info('✅ SMS verified | User: ' . $user->email);

        // Set SMS as verified
        $user->is_verified = true;
        $user->sms_code = null;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'SMS verified successfully! You can now log in.',
            'data' => [
                'user_id' => $user->id,
                'email' => $user->email,
                'phone_num' => $user->phone_num,
                'email_verified' => true,
                'sms_verified' => true,
                'fully_verified' => true
            ]
        ], 200);
    }

    /**
     * Get user profile
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'success' => true,
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone_num' => $user->phone_num,
                    'address' => $user->address,
                    'district' => $user->district,
                    'date_of_birth' => $user->date_of_birth,
                    'gender' => $user->gender,
                    'profile_image_url' => $user->profile_image_url,
                    'acc_no' => $user->acc_no,
                    'bank_name' => $user->bank_name,
                    'branch' => $user->branch,
                    'role' => $user->role,
                    'status' => $user->status,
                    'last_login' => $user->last_login,
                    'created_at' => $user->created_at,
                ]
            ]
        ], 200);
    }

    /**
     * Update user profile
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'address' => 'sometimes|required|string|max:255',
            'district' => 'sometimes|required|string|max:255',
            'phone_num' => 'sometimes|required|string|max:16|regex:/^\+?[0-9]{7,15}$/',
            'date_of_birth' => 'sometimes|required|date|before:today',
            'gender' => 'sometimes|nullable|in:male,female,other',
            'acc_no' => 'sometimes|nullable|string|max:255',
            'bank_name' => 'sometimes|nullable|string|max:255',
            'branch' => 'sometimes|nullable|string|max:255',
            'profile_image' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $updateData = $request->only([
                'name', 'address', 'district', 'phone_num', 'date_of_birth', 
                'gender', 'acc_no', 'bank_name', 'branch'
            ]);

            // Handle profile image upload
            if ($request->hasFile('profile_image')) {
                // Delete old image if exists
                if ($user->profile_image) {
                    Storage::disk('public')->delete($user->profile_image);
                }
                
                $updateData['profile_image'] = $request->file('profile_image')->store('profile_images', 'public');
            }

            $user->update($updateData);

            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'phone_num' => $user->phone_num,
                        'address' => $user->address,
                        'district' => $user->district,
                        'date_of_birth' => $user->date_of_birth,
                        'gender' => $user->gender,
                        'profile_image_url' => $user->profile_image_url,
                        'acc_no' => $user->acc_no,
                        'bank_name' => $user->bank_name,
                        'branch' => $user->branch,
                    ]
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('Profile update failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Profile update failed'
            ], 500);
        }
    }

    /**
     * Update profile image
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfileImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();

        try {
            // Delete old image if exists
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }

            // Store new image
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            
            $user->update(['profile_image' => $imagePath]);

            return response()->json([
                'success' => true,
                'message' => 'Profile image updated successfully',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'phone_num' => $user->phone_num,
                        'address' => $user->address,
                        'district' => $user->district,
                        'date_of_birth' => $user->date_of_birth,
                        'gender' => $user->gender,
                        'profile_image_url' => $user->profile_image_url,
                        'role' => $user->role,
                        'status' => $user->status,
                    ]
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('Profile image update failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Profile image update failed'
            ], 500);
        }
    }

    /**
     * Delete profile image
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteProfileImage(Request $request)
    {
        $user = $request->user();

        try {
            // Delete image file if exists
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }

            // Update user record
            $user->update(['profile_image' => null]);

            return response()->json([
                'success' => true,
                'message' => 'Profile image deleted successfully',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'phone_num' => $user->phone_num,
                        'address' => $user->address,
                        'district' => $user->district,
                        'date_of_birth' => $user->date_of_birth,
                        'gender' => $user->gender,
                        'profile_image_url' => $user->profile_image_url,
                        'role' => $user->role,
                        'status' => $user->status,
                    ]
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('Profile image deletion failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Profile image deletion failed'
            ], 500);
        }
    }

    /**
     * Change password
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Current password is incorrect'
            ], 400);
        }

        try {
            $user->update(['password' => $request->new_password]); // Will be hashed automatically

            return response()->json([
                'success' => true,
                'message' => 'Password changed successfully'
            ], 200);

        } catch (\Exception $e) {
            Log::error('Password change failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Password change failed'
            ], 500);
        }
    }

    /**
     * Logout user
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'success' => true,
                'message' => 'Successfully logged out'
            ], 200);

        } catch (\Exception $e) {
            Log::error('Logout failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Logout failed'
            ], 500);
        }
    }

    /**
     * Resend email verification code
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resendEmailVerificationCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if ($user->is_email_verified) {
            return response()->json([
                'success' => false,
                'message' => 'Email is already verified'
            ], 400);
        }

        try {
            $verificationCode = rand(100000, 999999);
            $user->verification_code = $verificationCode;
            $user->save();

            Mail::to($user->email)->send(new SendVerificationCode($verificationCode));

            Log::info("📧 Email OTP resent | Email: {$user->email} | Code: {$verificationCode}");

            return response()->json([
                'success' => true,
                'message' => 'Email verification code sent successfully'
            ], 200);

        } catch (\Exception $e) {
            Log::error('Failed to resend email verification code: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to send verification code'
            ], 500);
        }
    }

    /**
     * Resend SMS verification code
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resendSmsVerificationCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string|regex:/^\+?[0-9]{7,15}$/',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::where('phone_num', $request->phone)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        if ($user->is_verified) {
            return response()->json([
                'success' => false,
                'message' => 'Phone number is already verified'
            ], 400);
        }

        try {
            $smsCode = rand(100000, 999999);
            $user->sms_code = $smsCode;
            $user->save();

            $smsService = new DialogSMSService();
            $smsMessage = "Your SMS verification code is: {$smsCode}";
            $smsService->sendSMS($user->phone_num, $smsMessage);

            Log::info("📱 SMS OTP resent | Phone: {$user->phone_num} | Code: {$smsCode}");

            return response()->json([
                'success' => true,
                'message' => 'SMS verification code sent successfully'
            ], 200);

        } catch (\Exception $e) {
            Log::error('Failed to resend SMS verification code: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to send SMS code'
            ], 500);
        }
    }
}
