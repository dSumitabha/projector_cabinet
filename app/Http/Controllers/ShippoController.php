<?php

namespace App\Http\Controllers;

use Shippo;
use Shippo_Shipment;
use Shippo_Transaction;
use Illuminate\Http\Request;

class ShippoController extends Controller
{
    public function createShipment()
    {
        Shippo::setApiKey(env('SHIPPO_API_KEY'));

        $sender = [
            'name' => 'Your Store',
            'street1' => '652 Foster Lane',
            'city' => 'Mount Juliet',
            'state' => 'TN',
            'zip' => '37122',
            'country' => 'US'
        ];

        $receiver = [
            'name' => 'Customer',
            'street1' => '10065 Donner Pass Rd',
            'city' => 'Truckee',
            'state' => 'CA',
            'zip' => '96162',
            'country' => 'US'
        ];



        $parcels = [
            [
                'length' => '50',
                'width' => '20',
                'height' => '8',
                'distance_unit' => 'in',
                'weight' => '68',
                'mass_unit' => 'lb'
            ],
            [
                'length' => '50',
                'width' => '20',
                'height' => '8',
                'distance_unit' => 'in',
                'weight' => '67',
                'mass_unit' => 'lb'
            ],
            [
                'length' => '50',
                'width' => '20',
                'height' => '8',
                'distance_unit' => 'in',
                'weight' => '68',
                'mass_unit' => 'lb'
            ]
        ];

        $shipments = [];
        $delivery_times = [];  // Initialize array
        $total_shipping_cost = 0;
        $currency = 'USD';

        foreach ($parcels as $parcel) {
            $shipment = Shippo_Shipment::create([
                'address_from' => $sender,
                'address_to' => $receiver,
                'parcels' => [$parcel],
                'async' => false
            ]);

            $shipments[] = $shipment;
        }

        foreach ($shipments as $shipment) {
            $cheapest_rate = collect($shipment['rates'])->sortBy('amount')->first();

            if ($cheapest_rate) {
                $total_shipping_cost += floatval($cheapest_rate['amount']);
                $currency = $cheapest_rate['currency'];
                $delivery_times[] = $cheapest_rate['duration_terms'] ?? 'N/A';

                // Create transaction (purchase the shipping label)
                $transaction = Shippo_Transaction::create([
                    'rate' => $cheapest_rate['object_id'],
                    'label_file_type' => 'PDF',
                    'async' => false
                ]);
            }
        }

        return response()->json([
            'message' => 'Shipping labels generated successfully',
            'estimated_delivery_time' => implode(', ', array_unique($delivery_times)),
            'total_shipping_cost' => number_format($total_shipping_cost, 2) . " " . $currency,
        ]);
    }
}
