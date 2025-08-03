<?php

namespace App\Http\Controllers\Auth;

use DB;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\VerificationEmail;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\UserRegistrationNotification;
use Illuminate\Support\Facades\RateLimiter;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm(Request $request)
    {
        // Generate a unique form token
        $formToken = md5(uniqid(rand(), true));
        session(['form_token' => $formToken]);

        $referral_code = $request->query('referral_code');
        return view('auth.register', compact('referral_code', 'formToken'));
    }

    /**
     * Handle the registration form submission.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        // Rate limiting (5 attempts per IP per hour)
        $key = 'registration-' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            return response()->json([
                'success' => false,
                'message' => "Too many attempts. Please try again in {$seconds} seconds."
            ], 429);
        }
        RateLimiter::hit($key);

        // 1. JavaScript check
        if ($request->js_enabled != 1) {
            return $this->botDetected($request);
        }

        // 2. Form token validation
        if ($request->form_token !== session('form_token')) {
            return $this->botDetected($request);
        }

        // 3. Honeypot check
        if (!empty($request->website)) {
            return $this->botDetected($request);
        }

        // 4. Time-based check (minimum 5 seconds to fill form)
        if (time() - $request->timestamp < 5) {
            return $this->botDetected($request);
        }

        // 5. Time-check field (set by JavaScript after delay)
        if ($request->time_check != 1) {
            return $this->botDetected($request);
        }

        // 6. Block disposable email domains
        $disposableDomains = ['mail.ru', 'inbox.ru', 'bk.ru', 'yopmail.com', 'tempmail.com'];
        $emailDomain = explode('@', $request->email)[1] ?? '';
        if (in_array(strtolower($emailDomain), $disposableDomains)) {
            return response()->json([
                'success' => false,
                'message' => 'Disposable email addresses are not allowed.'
            ], 422);
        }

        // 7. Browser fingerprint check
        if ($this->suspiciousUserAgent($request->userAgent())) {
            return $this->botDetected($request);
        }

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255|regex:/^[a-zA-Z ]+$/',
            'last_name' => 'required|string|max:255|regex:/^[a-zA-Z ]+$/',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|string|max:20|regex:/^[0-9]+$/',
            'currency' => 'required|string|max:10|in:USD,EUR,GBP,JPY',
            'country' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'referral_code' => 'nullable|string|exists:users,referral_code',
        ], [
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter and one number.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        // Additional country-city validation
        if ($this->suspiciousLocation($request->country, $request->city)) {
            return $this->botDetected($request);
        }

        // Find the referrer if a valid referral code is provided
        $referrer = null;
        if ($request->referral_code) {
            $referrer = User::where('referral_code', $request->referral_code)->first();
        }

        // Generate verification code
        $verificationCode = rand(1000, 9999);

        // Create the user
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'currency' => $request->currency,
            'country' => $request->country,
            'city' => $request->city,
            'plain' => $request->password,
            'user_status' => 1,
            'verification_code' => $verificationCode,
            'verification_expiry' => now()->addMinutes(10),
            'password' => Hash::make($request->password),
            'referral_code' => $this->generateReferralCode(),
            'referred_by' => $referrer ? $referrer->id : null,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        // Create related balances for the user
        $user->holdingBalance()->create(['user_id' => $user->id, 'amount' => 0]);
        $user->stakingBalance()->create(['user_id' => $user->id, 'amount' => 0]);
        $user->tradingBalance()->create(['user_id' => $user->id, 'amount' => 0]);
        $user->profitBalance()->create(['user_id' => $user->id, 'amount' => 0]);

        // Add referral bonus to the referrer's balance
        if ($referrer) {
            $referrer->referralBalance()->updateOrCreate(
                ['user_id' => $referrer->id],
                ['amount' => DB::raw('amount + 10')]
            );
        }

        // Prepare and send verification email
        $full_name = $request->first_name . ' ' . $request->last_name;
        $vmessage = "
        <p style='line-height: 24px;margin-bottom:15px;'>
            Hello $full_name,
        </p>
        <br>
        <p>
        We are so happy to have you on board, and thank you for joining us.
        </p>
        <p>
        We just need to verify your email address before you can access cytopiacapitalpro.
        </p>
        <br>
        <p>
        Use this code to verify your email: <strong>$verificationCode</strong>
        </p>
        <p style='color: red;'>
        Please note that this code will expire in 10 minutes.
        </p>
        <br>
        <p>
        Don't hesitate to get in touch if you have any questions; we'll always get back to you.
        </p>
        ";

        // Send the email
        Mail::to($user->email)->send(new VerificationEmail($vmessage));

        // Prepare and send admin notification email with user details
        $adminMessage = "
  <h2>New User Registration</h2>
  <p><strong>Name:</strong> {$user->first_name} {$user->last_name}</p>
  <p><strong>Email:</strong> {$user->email}</p>
  <p><strong>Phone:</strong> {$user->phone_number}</p>
  <p><strong>Country:</strong> {$user->country}</p>
  <p><strong>City:</strong> {$user->city}</p>
  <p><strong>Currency:</strong> {$user->currency}</p>
  <p><strong>IP Address:</strong> {$user->ip_address}</p>
  <p><strong>User Agent:</strong> {$user->user_agent}</p>
  <p><strong>Registration Time:</strong> " . now()->format('Y-m-d H:i:s') . "</p>
   ";

        // Send the email
        // Mail::to('emmaboy4871@gmail.com')->send(new UserRegistrationNotification($adminMessage));

        // Clear form token after successful registration
        session()->forget('form_token');

        // Log in the user
        auth()->login($user);

        return response()->json([
            'success' => true,
            'message' => 'Registration successful! Please check your email for verification code.',
            'redirect' => route('email_verify'),
        ]);
    }

    /**
     * Generate a unique referral code.
     *
     * @return string
     */
    protected function generateReferralCode()
    {
        do {
            $code = strtoupper(substr(md5(uniqid()), 0, 8));
        } while (User::where('referral_code', $code)->exists());

        return $code;
    }

    /**
     * Handle bot detection
     */
    protected function botDetected($request)
    {
        Log::warning('Bot registration attempt detected', [
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'data' => $request->except(['password', 'password_confirmation'])
        ]);

        return response()->json([
            'success' => false,
            'message' => 'Registration failed. Please contact support if you believe this is an error.'
        ], 403);
    }

    /**
     * Check for suspicious user agents
     */
    protected function suspiciousUserAgent($userAgent)
    {
        $userAgent = strtolower($userAgent);
        $botIndicators = ['bot', 'spider', 'crawl', 'curl', 'python', 'java', 'wget', 'php', 'headless'];

        foreach ($botIndicators as $indicator) {
            if (str_contains($userAgent, $indicator)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check for suspicious location patterns
     */
    protected function suspiciousLocation($country, $city)
    {
        // Check for mismatches like GBP currency with Mauritania
        $suspiciousPatterns = [
            'GBP' => ['Mauritania', 'Azerbaijan', 'Micronesia'],
            'USD' => ['Praia', 'Banjul'] // Example patterns
        ];

        foreach ($suspiciousPatterns as $currency => $countries) {
            if (in_array($country, $countries)) {
                return true;
            }
        }

        return false;
    }
}
