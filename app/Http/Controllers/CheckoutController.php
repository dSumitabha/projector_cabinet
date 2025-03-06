<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Braintree\Gateway;
use App\Models\SalesRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $rate = SalesRate::first();
        $carts = collect(); // Default empty cart

        if (Auth::check()) {
            // Fetch cart by user_id for logged-in users
            $carts = Cart::where('user_id', Auth::id())->with('product.productImages')->get();
        } else {
            // Fetch cart by cookie_id for guest users
            $cookieId = Cookie::get('cart_cookie_id');
            if ($cookieId) {
                $carts = Cart::where('cookie_id', $cookieId)->with('product.productImages')->get();
            }
        }

        // **Redirect if the cart is empty**
        if ($carts->isEmpty()) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty. Please add products before proceeding to checkout.');
        }

        // Store the current route in session before showing the login form
        if (!session()->has('url.intended')) {
            session(['url.intended' => url()->previous()]);
        }

        return view('checkout', compact('carts', 'rate'));
    }
}
