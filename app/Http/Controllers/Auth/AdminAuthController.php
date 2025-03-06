<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{

    public function showAuthenticationPage()
    {
        return view('admin.pages.authentication');
    }

    // Handle the login request
    public function signIn(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->user_type === 1) {

                return redirect()->route('dashboard'); // Redirect to a protected admin area
            } else {
                Auth::logout(); // Ensure user is logged out if not admin
                return back()->withErrors([
                    'email' => 'Access denied. Only admins can log in here.',
                ]);
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Logout function
    public function signOut()
    {
        Auth::logout();
        return redirect()->route('admin_authentication'); 
    }
}

