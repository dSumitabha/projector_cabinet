<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\Models\Shipment;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Shippo;
use Shippo_Shipment;
use Shippo_Transaction;
use Stripe;
use App\Mail\SendOrderConfirmationEmail;
use App\Mail\OrderConfirmationMail;

class ProcessOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $customer_email, $to_address, $parcels, $products, $amount, $session_id, $order_id;

    public function __construct($customer_email, $to_address, $parcels, $products, $amount, $session_id, $order_id)
    {
        $this->customer_email = $customer_email;
        $this->to_address = $to_address;
        $this->parcels = $parcels;
        $this->products = $products;
        $this->amount = $amount;
        $this->session_id = $session_id;
        $this->order_id = $order_id;
    }

    public function handle()
    {
        $order = Order::find($this->order_id);

        // Save Order Items
        foreach ($this->products as $product) {
            OrderItem::create([
                'order_id' => $this->order_id,
                'product_id' => $product['id'],
                'product_name' => $product['name'],
            ]);
        }

        // Process Shippo Shipment
        Shippo::setApiKey(env('SHIPPO_API_KEY'));
        $tracking_details = [];

        foreach ($this->parcels as $parcel) {
            $shipment = Shippo_Shipment::create([
                'address_from' => [
                    'name' => 'Your Store',
                    'street1' => '652 Foster Lane',
                    'city' => 'Mount Juliet',
                    'state' => 'TN',
                    'zip' => '37122',
                    'country' => 'US'
                ],
                'address_to' => $this->to_address,
                'parcels' => [$parcel],
                'async' => false
            ]);

            if (!empty($shipment['rates'])) {
                $cheapest_rate = collect($shipment['rates'])->sortBy('amount')->first();

                if ($cheapest_rate) {
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
                            'order_id' => $this->order_id,
                            'carrier' => $cheapest_rate['provider'],
                            'service' => $cheapest_rate['servicelevel']['name'],
                            'tracking_number' => $transaction['tracking_number'],
                            'tracking_url' => $transaction['tracking_url_provider'],
                            'shipping_cost' => $cheapest_rate['amount'],
                            'currency' => $cheapest_rate['currency'],
                            'estimated_delivery' => $estimated_delivery_date
                        ]);
                    }
                }
            }
        }

        // Save Transaction
        Transaction::create([
            'order_id' => $this->order_id,
            'transaction_id' => $this->session_id,
            'amount' => $this->amount,
            'payment_method' => 'Stripe',
            'status' => 'completed'
        ]);

        // Send Confirmation Emails
        $admin_mail = 'nilanjana@starpactglobal.com';
        Mail::to($admin_mail)->send(new SendOrderConfirmationEmail($this->session_id, $this->amount, $tracking_details, $this->products, $this->to_address));
        Mail::to($this->customer_email)->send(new OrderConfirmationMail($this->session_id, $this->amount, $this->products));
    }
}
