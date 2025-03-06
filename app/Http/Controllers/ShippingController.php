<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Shippo;
use Shippo_Shipment;
use Shippo_Address;
class ShippingController extends Controller
{
    public function getShippingRate(Request $request)
    {
        Shippo::setApiKey(env('SHIPPO_API_KEY'));

        $from_address = [
            'name' => 'Your Store',
            'street1' => '652 Foster Lane',
            'city' => 'Mount Juliet',
            'state' => 'TN',
            'zip' => '37122',
            'country' => 'US'
        ];

        $to_address = Shippo_Address::create([
            'name' => 'Customer',
            'street1' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->pincode,
            'country' => 'US',
            'validate' => true
        ]);
        
        if (!$to_address['validation_results']['is_valid']) {
            return response()->json([
                'message' => 'Invalid shipping address. Please check the entered state, city, and postal code.',
                'error' => 'Address validation failed'
            ], 400);
        }
        $parcels = $request->parcels; // Get parcel data from AJAX request

        if (empty($parcels)) {
            return response()->json([
                'message' => 'No parcel details provided.',
                'error' => 'Missing parcel data'
            ], 400);
        }



        $shipments = [];
        foreach ($parcels as $parcel) {
            $shipment = Shippo_Shipment::create([
                'address_from' => $from_address,
                'address_to' => $to_address,
                'parcels' => [$parcel],
                'async' => false
            ]);

            if (empty($shipment['rates'])) {
                return response()->json([
                    'message' => 'Shipping not available for the provided address.',
                    'error' => 'No rates found'
                ], 400);
            }

            $shipments[] = $shipment;
        }

        $total_shipping_cost = 0;
        $currency = 'USD';

        foreach ($shipments as $shipment) {
            $cheapest_rate = collect($shipment['rates'])->sortBy('amount')->first();

            if ($cheapest_rate) {
                $total_shipping_cost += floatval($cheapest_rate['amount']);
                $currency = $cheapest_rate['currency'];

            }
        }

        if ($total_shipping_cost == 0) {
            return response()->json([
                'message' => 'Shipping not available for the provided address.',
                'error' => 'No valid rates found'
            ], 400);
        }

        return response()->json(['shipping_charge' => number_format($total_shipping_cost, 2) . " " . $currency]);
    }
}

