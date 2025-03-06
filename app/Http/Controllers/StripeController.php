<?php

namespace App\Http\Controllers;

use Shippo;
use Stripe\Stripe;
use App\Models\Cart;
use Shippo_Shipment;
use App\Models\Order;
use Shippo_Transaction;
use App\Models\Shipment;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOrderConfirmationEmail;
use App\Jobs\ProcessOrder;
class StripeController extends Controller
{
    public function createPayment(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => intval($request->total_amount * 100),
                'currency' => 'usd',
                'payment_method' => $request->payment_method_id,
                'confirmation_method' => 'manual',
                'confirm' => true,
                'return_url' => route('stripe.success') // Add this line
            ]);
            if ($paymentIntent->status === 'succeeded') {
            return response()->json([
                'success' => true,
                'session_id' => $paymentIntent->id, // Needed for frontend confirmation
                'redirect_url' => route('stripe.success')
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Payment failed. Try again.'
            ]);
        }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function success(Request $request)
{
    Stripe::setApiKey(env('STRIPE_SECRET'));

    $customer_email = session('email');
    $to_address = session('shipping_address');
    $parcels = session('parcels');
    $products = session('products');
    $amount = session('total_amount');

    Log::info('Stripe Payment Successful', [
        'email' => $customer_email,
        'shipping_address' => $to_address,
        'parcels' => $parcels,
        'products' => $products,
        'amount' => $amount
    ]);

    if (!$to_address || !$parcels) {
        return view('payment.failed')->with('message', 'Shipping details not found.');
    }

    // Create Order
    $order = Order::create([
        'order_number' => strtoupper(Str::random(10)),
        'customer_email' => $customer_email,
        'total_amount' => $amount,
        'status' => 'pending'
    ]);

    // Dispatch Background Job
    ProcessOrder::dispatch($customer_email, $to_address, $parcels, $products, $amount, $request->session_id, $order->id);

    // Clear Cart Instantly
    $cartQuery = auth()->check()
        ? Cart::where('user_id', auth()->id())
        : Cart::where('cookie_id', request()->cookie('cookie_id'));

    $cartQuery->delete();

    // Instantly Show Success Page
    return view('payment.stripe_success', [
        'transaction_id' => $request->session_id,
        'amount' => $amount,
        'currency' => 'USD',
        'customer_email' => $customer_email
    ]);
}

    public function cancel()
    {
        return view('payment.cancel');
    }
}
