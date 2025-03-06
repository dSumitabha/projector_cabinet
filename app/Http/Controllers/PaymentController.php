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
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOrderConfirmationEmail;

class PaymentController extends Controller
{
    protected $gateway;

    public function __construct()
    {
        $this->gateway = new Gateway([
            'environment' => 'sandbox', // Change to 'production' for live
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY')
        ]);
    }
    public function generateToken()
    {
        $gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchant_id'),
            'publicKey' => config('services.braintree.public_key'),
            'privateKey' => config('services.braintree.private_key'),
        ]);

        return response()->json([
            'client_token' => $gateway->clientToken()->generate()
        ]);
    }

    public function token()
    {
        return response()->json([
            'client_token' => $this->gateway->clientToken()->generate()
        ]);
    }

    // Process Braintree Payment
    public function checkout(Request $request)
    {
        $amount = $request->input('total_amount');
        $nonce = $request->input('payment_method_nonce');

        $result = $this->gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => ['submitForSettlement' => true]
        ]);

        if ($result->success) {

            // Set Shippo API Key
            Shippo::setApiKey(env('SHIPPO_API_KEY'));

            // Retrieve session data
            $to_address = session('shipping_address');
            $parcels = session('parcels');
            $customer_email = session('email');
            $products = session('products');


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
            foreach ($products as $product) {

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product['id'],
                    'product_name' => $product['name'],

                ]);
            }
            // Create shipments for each parcel separately
            $tracking_details = [];
            foreach ($parcels as $parcel) {
                $shipment = Shippo_Shipment::create([
                    'address_from' => $from_address,
                    'address_to' => $to_address,
                    'parcels' => [$parcel], // Single parcel per request
                    'async' => false
                ]);

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
            'transaction_id' => $result->transaction->id,
            'amount' => $amount,
            'payment_method' => 'Credit',
            'status' => 'completed'
        ]);
                    }
                }
            }
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
            // ✅ Dispatch email job in the background
            $admin_mail = 'praveen.matsa@ustprojectorcabinets.com'; // Change this dynamically if needed
             Mail::to($admin_mail)->send(new SendOrderConfirmationEmail($result->transaction->id, $amount, $tracking_details, $products,$to_address));


             Mail::to($customer_email)->send(new OrderConfirmationMail($result->transaction->id,$amount,$products));

            // ✅ Return success response immediately
            return response()->json([
                'success' => true,
                'transaction_id' => $result->transaction->id,
                'amount' => $amount,
                'customer_email' => $customer_email,
                'tracking_details' => $tracking_details
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => $result->message
            ]);
        }
    }

    public function success(Request $request)
    {
        session(['transaction_id' => $request->query('transaction_id')]);
        session(['amount' => $request->query('amount')]);
        session(['customer_email' => $request->query('customer_email')]);

        return view('payment.credit_success');
    }

    public function failed()
    {
        return view('payment.failed');
    }
}
