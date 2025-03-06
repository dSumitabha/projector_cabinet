<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Mail\WelcomeMail;
use App\Mail\RegisterMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class AuthCOntroller extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->user_type == 0) {
                // Retrieve the cookie_id for the guest user
                $cookieId = Cookie::get('cart_cookie_id');

                if ($cookieId) {
                    // Update cart items by replacing cookie_id with the logged-in user's user_id
                    Cart::where('cookie_id', $cookieId)
                        ->update(['user_id' => $user->id, 'cookie_id' => null]);

                    // Optionally, delete the cookie after updating
                    Cookie::queue(Cookie::forget('cart_cookie_id'));
                }

                // Retrieve and forget the stored route from session
                $redirectTo = session('url.intended', route('all_products'));
                session()->forget('url.intended');

                return redirect($redirectTo)->with('success', 'Login successful');
            }
            else
            {
                return back()->with('error', 'Do not Login from Admin Credentials');
            }

        }

        return back()->with('error', 'Invalid credentials');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->back()->with('success', 'Logged out successfully');
    }
    public function register()
    {

       return view('register');
    }
    public function registerSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phonenumber' => 'required|numeric',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors(),
            ]);
        }

        $user = new User();
        $user->name = $request->firstname . ' ' . $request->lastname;
        $user->email = $request->email;
        $user->phone_number = $request->phonenumber;
        $user->user_type = '0';
        $user->password = Hash::make($request->password);
        $user->save();

        // ✅ Log in the user immediately
        Auth::login($user);

        // ✅ Prepare JSON response first
        $responseContent = json_encode([
            'status' => 200,
            'msg' => 'Registration successful. Please log in.',
            'redirect_url' => route('all_products')
        ]);

        // ✅ Check if output buffering is active before clearing
        if (ob_get_level() > 0) {
            ob_end_clean();
        }

        // ✅ Send response & close connection
        header("Connection: close");
        header("Content-Length: " . strlen($responseContent));
        header("Content-Type: application/json");
        echo $responseContent;
        flush();

        // ✅ Allow PHP to continue processing (if FastCGI is available)
        if (function_exists('fastcgi_finish_request')) {
            fastcgi_finish_request();
        }

        // ✅ Send email in the background
        try {
            Mail::to('nilanjana@starpactglobal.com')->send(new RegisterMail($user->toArray()));
             // Send email to the newly registered user
        Mail::to($user->email)->send(new WelcomeMail($user));
        } catch (\Exception $e) {
            Log::error('Mail sending failed: ' . $e->getMessage());
        }
    }
    public function login_form()
    {

       return view('login');
    }
}
