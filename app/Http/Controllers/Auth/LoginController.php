<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/'; // Redirects authenticated users to the home page.

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle authentication logic and validate credentials.
     */
    public function login(Request $request)
    {
        // Validate request data
        $request->validate([
            'email' => 'required|email|exists:users,email', // Ensure email exists in the database
            'password' => 'required|string',
        ]);
        $user = User::where('email', $request->email)->first();
        if(!$user){
            return back()->withErrors([
                'email' => 'User not found.',
            ])->withInput();
        }
        
        if($user->is_verified == 0){
            return back()->withErrors([
                'email' => 'Your account is not verified. Please check your email for verification instructions.',
            ])->withInput();
        }

        // Get credentials
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        // Attempt to authenticate the user
        if (Auth::attempt($credentials, $remember)) {
            // Update last login timestamp
            $this->authenticated($request, Auth::user());

            // Redirect to the intended page or the default redirect path
            return redirect()->intended($this->redirectPath());
        }

        // If authentication fails, return with an error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    /**
     * Update the last login timestamp after authentication.
     */
    protected function authenticated(Request $request, $user)
    {
        $user->last_login = Carbon::now();
        $user->save();
    }

    /**
     * Log out the user and invalidate the session.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home'); // Redirect to home after logout
    }
}
