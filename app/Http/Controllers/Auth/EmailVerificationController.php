<?php

namespace App\Http\Controllers\Auth;

use App\Mail\WelcomeEmail;
use Illuminate\Http\Request;
use App\Mail\VerificationEmail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmailVerificationController extends Controller
{



    public function emailVerify()
    {
        // Check if the user is authenticated

        // Redirect if email_verification is 1
        if (Auth::user()->email_verification == 1) {
            return redirect('/home');
        }

        // Show the email verification page
        return view('auth.email_verify');
    }



    // public function userVerify()
    // {

    //     // Redirect if email_status is 1
    //     if (Auth::user()->user_status == 1) {
    //         return redirect('/home');
    //     }


    //     return view('auth.user_verify');
    // }


    public function skipCode(Request $request)
    {
        // Validate the input
        $user = Auth::user();
        // Mark email as verified
        $user->email_verification = 1;
        $user->save();
        // Redirect the user to the next step or home page
        return redirect()->route('home')->with('success', 'Verification skipped successfully!');
    }






    public function verifyCode(Request $request)
    {
        // Validate the input
        $request->validate([
            'verification_code' => ['required', 'integer'],
        ]);

        $user = Auth::user();

        // Check if the verification code is correct and not expired
        if ($user->verification_code === $request->verification_code) {
            if (now()->lt($user->verification_expiry)) {
                // Mark email as verified
                $user->email_verification = 1;
                $user->save();



                $full_name = $user->name;
                $email = $user->email;
                $password = $user->password; // Be cautious; never expose raw passwords!





                $wMessage = "<p style='line-height: 24px;margin-bottom:15px;'>
                Hello $full_name,
                </p>
                <br>
                <p>We are so happy to have you on board, and thank you for joining us.</p>
                <br>
                  <p><strong>Email Address:</strong>  $email </p>
                <p><strong>Account Number:</strong> $password</p>
                <br>
                <p>Don't hesitate to get in touch if you have any questions; we'll always get back to you</p>";



                Mail::to($email)->send(new WelcomeEmail($wMessage));

                return redirect()->route('home')->with('success', 'Your email has been verified successfully!');
            } else {
                return redirect()->back()->with('error', 'The verification code has expired. Please request a new one.');
            }
        } else {
            return back()->with('error', 'The verification code is incorrect.');
        }
    }



    public function resendVerificationCode(Request $request)
    {
        $user = $request->user();

        // Generate and save the verification code and expiry time
        $validToken = rand(1000, 9999);
        $user->verification_code = $validToken;
        $user->verification_expiry = now()->addMinutes(10); // Code expires in 10 minutes
        $user->save();
 
        $full_name =  $user->first_name . ' ' .  $user->last_name;
        $email = $user->email;

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
      Use this code to verify your email: <strong>$validToken</strong>
      </p>
      <p style='color: red;'>
      Please note that this code will expire in 10 minutes.
     </p>
    <br>
    <p>
    Don't hesitate to get in touch if you have any questions; we'll always get back to you.
    </p>
    ";

        Mail::to($email)->send(new VerificationEmail($vmessage));

        // Flash success message to the session
        return redirect()->back()->with('success', 'A new verification code has been sent to your email.');
    }
}
