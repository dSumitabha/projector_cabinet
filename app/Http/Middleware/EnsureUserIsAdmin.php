<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->user_type == 1) {
                // If admin is already logged in, allow access
                return $next($request);
            } else {
                // If not an admin, log out and redirect to admin_authentication with an error message
                Auth::logout();
                return redirect()->route('admin_authentication')->with('error', 'You must be an admin to view this page.');
            }
        }

        // If the user is not logged in, redirect to admin_authentication
        return redirect()->route('admin_authentication')->with('error', 'You must be an admin to view this page.');
    }
}
