<?php

namespace App\Http\Controllers;

use App\Models\UserAddress;
use Illuminate\Http\Request;

class UserAddressController extends Controller
{
    public function getUserAddresses(Request $request)
    {
        $addresses = UserAddress::where('user_id', $request->user_id)->get();
        return response()->json($addresses);
    }

    public function getAddressDetails(Request $request)
    {
        $address = UserAddress::where('id', $request->address_id)->where('user_id', auth()->id())->first();

        if (!$address) {
            return response()->json(['error' => 'Address not found'], 404);
        }

        return response()->json($address);
    }
}
