<?php

namespace App\Http\Controllers;

use Shippo;
use App\Models\Cart;

use Shippo_Shipment;
use App\Models\Order;
use Braintree\Gateway;
use Shippo_Transaction;
use App\Models\Shipment;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOrderConfirmationEmail;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalController extends Controller
{
    public function storeTotalAmount(Request $request)
    {

        session(['total_amount' => $request->total_amount]); // Store amount in session
        session()->put('shipping_address', $request->address);
        session()->put('parcels', $request->parcels);
        session()->put('products', $request->products);

        session()->put('email', $request->email);
        return response()->json(['total_amount' => $request->total_amount]);
    }
    public function createPayment()
    {
        $paypal = new PayPalClient;
        $paypal->setApiCredentials(config('paypal'));
        $paypalToken = $paypal->getAccessToken();

        $totalAmount = session('total_amount', 0); // Ensure this session is set in your frontend

        $order = $paypal->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => number_format($totalAmount, 2, '.', '')
                    ]
                ]
            ],
            "application_context" => [
                "cancel_url" => route('paypal.cancel'),
                "return_url" => route('paypal.success'),
            ]
        ]);

        return redirect($order['links'][1]['href']);
    }
    public function success(Request $request)
    {
        $paypal = new PayPalClient;
        $paypal->setApiCredentials(config('paypal'));
        $paypalToken = $paypal->getAccessToken();

        $response = $paypal->capturePaymentOrder($request->token);

        if ($response['status'] == 'COMPLETED') {
            // Retrieve session data
            $to_address = session('shipping_address');
            $parcels = session('parcels');
            $email = session('email');
            $products = session('products');


            Log::info('Session Data:', [
                'email' => $email,
                'shipping_address' => $to_address,
                'parcels' => $parcels,
                'products' => $products,
            ]);
 // Set Shippo API Key
 Shippo::setApiKey(env('SHIPPO_API_KEY'));

 // Retrieve session data
 $to_address = session('shipping_address');
 $parcels = session('parcels');
 $customer_email = session('email');
 $products = session('products');

 $amount = session('total_amount');


 if (!$to_address || !$parcels) {
     return response()->json([
         'success' => false,
         'error' => 'Shipping details not found.'
     ]);
 }
  // Create Order
  $order = Order::create([
    'order_number' => strtoupper(Str::random(10)),
    'customer_email' => $customer_email,
    'total_amount' => $amount,
    'status' => 'pending'
]);
 // Sender's address
 $from_address = [
     'name' => 'Your Store',
     'street1' => '652 Foster Lane',
     'city' => 'Mount Juliet',
     'state' => 'TN',
     'zip' => '37122',
     'country' => 'US'
 ];

 // Create shipments for each parcel separately
 $tracking_details = [];
 foreach ($parcels as $parcel) {
     $shipment = Shippo_Shipment::create([
         'address_from' => $from_address,
         'address_to' => $to_address,
         'parcels' => [$parcel], // Single parcel per request
         'async' => false
     ]);
     foreach ($products as $product) {

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product['id'],
            'product_name' => $product['name'],

        ]);
    }
     if (empty($shipment['rates'])) {
         return response()->json([
             'success' => false,
             'error' => 'No shipping rates available.'
         ]);
     }

     // Select the cheapest rate
     $cheapest_rate = collect($shipment['rates'])->sortBy('amount')->first();

     if ($cheapest_rate) {
         // Purchase shipping label
         $transaction = Shippo_Transaction::create([
             'rate' => $cheapest_rate['object_id'],
             'label_file_type' => 'PDF',
             'async' => false
         ]);

         if ($transaction['status'] === 'SUCCESS') {
            $estimated_delivery_date = $cheapest_rate['estimated_days']
            ? date('Y-m-d', strtotime("+" . $cheapest_rate['estimated_days'] . " days"))
            : null;
             $tracking_details[] = [
                 'carrier' => $cheapest_rate['provider'],
                 'service' => $cheapest_rate['servicelevel']['name'],
                 'tracking_number' => $transaction['tracking_number'] ?? 'N/A',
                 'tracking_url' => $transaction['tracking_url_provider'] ?? 'N/A',
                 'label_url' => $transaction['label_url'] ?? 'N/A',
                 'shipping_cost' => $cheapest_rate['amount'],
                 'currency' => $cheapest_rate['currency'],
                 'estimated_delivery' => $estimated_delivery_date
             ];

               // Save Shipment
        Shipment::create([
            'order_id' => $order->id,
            'carrier' => $cheapest_rate['provider'],
            'service' => $cheapest_rate['servicelevel']['name'],
            'tracking_number' => $transaction['tracking_number'],
            'tracking_url' =>$transaction['tracking_url_provider'],
            'shipping_cost' => $cheapest_rate['amount'],
            'currency' => $cheapest_rate['currency'],
            'estimated_delivery' => $estimated_delivery_date

        ]);

        // Save Transaction
        Transaction::create([
            'order_id' => $order->id,
            'transaction_id' => $response['id'],
            'amount' => $amount,
            'payment_method' => 'Paypal',
            'status' => 'completed'
        ]);
         }
     }
 }

            if (!$to_address || !$parcels) {
                return view('payment.failed')->with('message', 'Shipping details not found.');
            }

            $amount = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];
            $currency = $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'];
            // ✅ Send emails asynchronously (Queue them if necessary)

            $admin_mail = 'praveen.matsa@ustprojectorcabinets.com';
             Mail::to($admin_mail)->send(new SendOrderConfirmationEmail($response['id'], $amount, $tracking_details, $products, $to_address));
             Mail::to($email)->send(new OrderConfirmationMail($response['id'],$amount,$products));
            $cartQuery = Cart::query();

            if (auth()->check()) {
                // If user is logged in, use user_id
                $cartQuery->where('user_id', auth()->id());
            } elseif (request()->hasCookie('cookie_id')) {
                // If user_id is not present, use cookie_id
                $cartQuery->where('cookie_id', request()->cookie('cookie_id'));
            }

            // Delete the user's cart items
            $cartQuery->delete();
            return view('payment.paypal_success', [
                'transaction_id' => $response['id'],
                'amount' => $amount,
                'currency' => $currency,
                'customer_email' => $email
            ]);


        } else {
            return view('payment.failed');
        }
    }


    public function cancel()
    {
        return view('payment.cancel'); // Create a cancel view
    }


    public function braintreePayment(Request $request)
    {
        $gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY'),
        ]);

        $result = $gateway->transaction()->sale([
            'amount' => session('total_amount'),
            'paymentMethodNonce' => $request->payment_method_nonce,
            'options' => ['submitForSettlement' => true]
        ]);

        if ($result->success) {
            return response()->json(['success' => true, 'transaction_id' => $result->transaction->id]);
        } else {
            return response()->json(['success' => false, 'message' => $result->message]);
        }
    }
}
