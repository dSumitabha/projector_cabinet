<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LocationController extends Controller
{
    public function getLocationFromPostalCode($postalcode)
    {

        // Zippopotam.us API endpoint for location lookup
        $response = Http::get("https://api.zippopotam.us/us/{$postalcode}");

        // Check if the response is successful
        if ($response->successful()) {
            dd($response->json());
            $data = $response->json();

            // Check if the country is 'US' in the response
            if (isset($data['country']) && $data['country'] === 'United States') {
                // Check if there are places in the response
                if (isset($data['places']) && count($data['places']) > 0) {
                    // Extract the first place
                    $firstPlace = $data['places'][0];

                    // Extract country and state from the first place
                    $country = $data['country'];
                    $state = $firstPlace['state'];

                    // Return the country and state
                    return response()->json([
                        'country' => $country,
                        'state' => $state
                    ]);
                } else {
                    return response()->json(['error' => 'No places found for this postal code'], 404);
                }
            } else {
                // If the country is not US, return a specific error message
                return response()->json(['error' => 'This postal code is not from the USA.'], 400);
            }
        }
        dd('Error:', $response->status());
        // If the API call was not successful
        return response()->json([
           'error' => 'We do not deliver to this location. Please try another postal code.'
        ], 400);
    }
}
