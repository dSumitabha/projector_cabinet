<?php

namespace App\Http\Controllers;


use App\Models\Cart;
use App\Models\SalesRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public function getCartCount()
{
    $cartCount = Cart::where(function($query) {
        if (Auth::check()) {
            $query->where('user_id', Auth::id());
        } else {
            // Use cookie_id instead of session_id for guest users
            $cookieId = Cookie::get('cart_cookie_id');

            if ($cookieId) {
                $query->where('cookie_id', $cookieId);
            } else {
                // If no cookie exists, return count as 0
                $query->whereNull('id');
            }
        }
    })->count();

    return response()->json(['count' => $cartCount]);
}
public function addToCart(Request $request)
{

    $productId = $request->input('product_id');
    $quantity = $request->input('quantity', 1);

    if (Auth::check()) {
        // Logged-in user
        $userId = Auth::id();

        $cart = Cart::updateOrCreate(
            ['user_id' => $userId, 'product_id' => $productId],
            ['quantity' => $quantity]
        );
    } else {
        // Guest user using cookie ID
        $cookieId = Cookie::get('cart_cookie_id');

        // If cookie ID is not set, generate a new one and store it in cookies
        if (!$cookieId) {
            $cookieId = uniqid('cart_', true);
            Cookie::queue('cart_cookie_id', $cookieId, 60 * 24 * 7); // Store for 7 days
        }

        $cart = Cart::updateOrCreate(
            ['cookie_id' => $cookieId, 'product_id' => $productId],
            ['quantity' => $quantity]
        );
    }

    return response()->json(['success' => true, 'message' => 'Product added to cart!']);
}


   public function viewCart()
{
    $rate = SalesRate::first();
    if (Auth::check()) {
        // Logged-in user
        $carts = Cart::where('user_id', Auth::id())->get();
    } else {
        // Guest user using cookie_id
        $cookieId = Cookie::get('cart_cookie_id');

        if (!$cookieId) {
            // If no cookie exists, set an empty cart
            $carts = collect();
        } else {
            $carts = Cart::where('cookie_id', $cookieId)->get();
        }
    }

    return view('cart', compact('carts','rate'));
}

  public function remove($id)
{
    // Find the cart item by its ID
    $cart = Cart::find($id);
// Get the updated cart count
$cartCount = Cart::count();
    // Check if the cart item exists
    if ($cart) {
        if (Auth::check()) {
            // Only remove the item if the cart belongs to the logged-in user
            if ($cart->user_id != Auth::id()) {
                return response()->json([
                    'success' => false,
                    'cartCount' => $cartCount,
                    'message' => 'You do not have permission to remove this item.'
                ]);
            }
        } else {
            // Guest user using cookie_id instead of session_id
            $cookieId = Cookie::get('cart_cookie_id');

            if (!$cookieId || $cart->cookie_id != $cookieId) {
                return response()->json([
                    'success' => false,
                    'cartCount' => $cartCount,
                    'message' => 'You do not have permission to remove this item.'
                ]);
            }
        }

        // Delete the cart item
        $cart->delete();

        // Return the updated cart count
        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart.',
            'cartCount' => $this->getCartCount() // Call method to get updated cart count
        ]);
    }

    // If the cart item doesn't exist, return an error
    return response()->json([
        'success' => false,
        'message' => 'Item not found in cart.'
    ]);
}
}
