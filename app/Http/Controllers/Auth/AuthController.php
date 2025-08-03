<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle user login.
     */

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'redirect' => route('home'),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid credentials, please try again.',
        ], 401);
    }



    // Show forgot password form
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    // Send reset link
    public function sendResetLinkEmail(Request $request)
    {
        // Validate the email
        $request->validate(['email' => 'required|email']);

        // Check if the email exists in the database
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Email not found in our database.',
            ], 404);
        }

        // Send the password reset link
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Return response based on the status
        return $status === Password::RESET_LINK_SENT
            ? response()->json(['success' => true, 'message' => __($status)])
            : response()->json(['success' => false, 'message' => __($status)], 400);
    }

    // Show reset password form
    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    // Reset password
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? response()->json(['success' => true, 'message' => __($status), 'redirect' => route('login')])
            : response()->json(['success' => false, 'message' => __($status)], 400);
    }


    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        Auth::logout(); // Logs out the user
        $request->session()->invalidate(); // Invalidates the session
        $request->session()->regenerateToken(); // Regenerates the CSRF token


        return redirect('/login'); // Redirects to the homepage or login page
    }
}
