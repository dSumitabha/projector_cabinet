<?php

namespace App\Http\Controllers\Frontend\ForgotPassword;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\PasswordOtpMail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('frontend.auth.forgotPassword.showLinkForm');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors(),
            ]);
        }

        $otp = rand(100000, 999999);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $otp,
                'created_at' => now(),
            ]
        );

        Mail::to($request->email)->send(new PasswordOtpMail($otp));

        session(['email' => $request->email, 'otp' => $otp]);

        return response()->json([
            'status' => 200,
            'msg' => 'OTP sent to your email address',
        ]);
    }



    public function checkOtp()
    {
        $email = session('email'); // Retrieve email from session

        if (!$email) {
            return redirect()->route('login')->with('error', 'No email found in session');
        }

        $maskedEmail = $this->maskEmail($email);

        return view('frontend.auth.forgotPassword.checkOtp', compact('maskedEmail'));
    }

    public function maskEmail($email)
    {
        if (!$email) return ''; // If email is not set, return an empty string

        $emailParts = explode('@', $email);
        $localPart = $emailParts[0];
        $domainPart = $emailParts[1];

        $maskedLocalPart = str_repeat('*', strlen($localPart) - 4) . substr($localPart, -4); // Mask all except the last 4 chars of the local part
        return $maskedLocalPart . '@' . $domainPart;
    }

    public function verifyOtp(Request $request)
    {
        //  dd('ok');
        $validator = Validator::make($request->all(), [
            'otp' => 'required|numeric|digits:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors(),
            ]);
        }

        $email = session('email');
        if (!$email) {
            return response()->json([
                'status' => 400,
                'error' => ['email' => 'Session has expired, please request a new OTP.'],
            ]);
        }

        $passwordReset = DB::table('password_resets')
            ->where('email', $email)
            ->where('token', $request->otp)
            ->first();

        if (!$passwordReset) {
            return response()->json([
                'status' => 400,
                'error' => ['otp' => 'Invalid OTP, please try again.'],
            ]);
        }

        DB::table('password_resets')
            ->where('email', $email)
            ->where('token', $request->otp)
            ->delete();

        session()->forget(['otp']);

        return response()->json([
            'status' => 200,
            'msg' => 'OTP verified successfully!',
            // 'redirect_url' => route('password.update')
        ]);
    }




    public function showResetForm()
    {

        return view('frontend.auth.forgotPassword.showResetForm');
    }

    public function reset(Request $request)
    {
        // Retrieve email from session
        $email = session('email');

        // Validate the password and confirm_password
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|string|min:8|same:password', // Ensure both passwords match
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors(),
            ]);
        }

        // Find the user by the session email
        $user = User::where('email', $email)->first();

        // Check if the user exists
        if (!$user) {
            return response()->json([
                'status' => 400,
                'msg' => 'User not found.',
            ]);
        }

        // Update the user's password
        $user->password = Hash::make($request->password); // Hash the new password
        $user->save();
        session()->forget(['email']);


        return response()->json([
            'status' => 200,
            'msg' => 'Password changed successfully!',
        ]);
    }
}
