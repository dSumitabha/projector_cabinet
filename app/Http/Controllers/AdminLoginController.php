<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function admin_login()
    {

        return view('admin.pages.login.login');
    }
    public function admin_login_check(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);


        if (Auth::attempt(['email' => $request->email, 'password' => $request->password,'user_type'=>1])){
            return redirect()->intended(route('admin.dashboard'))
                        ->with('success','You have successfully signed in');
            }


        return redirect()->route('admin_login')->with('error','Login details are not valid');
    }
    public function admin_logout()
    {
        Auth::logout();
        return redirect()->route('admin_login')->with('success','You have been successfully logged out!');
    }
}
