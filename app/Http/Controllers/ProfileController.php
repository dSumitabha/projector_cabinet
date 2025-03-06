<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {

        $user_address = UserAddress::where('user_id', Auth::id())
            ->orderByRaw("FIELD(is_active, 'active', 'inactive')")
            ->get();
        return view('profile', compact('user_address'));
    }
    public function changePassword(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'status' => 401,
                'error' => 'Unauthorized',
            ]);
        }

        $validator = Validator::make($request->all(), [
            'old_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors(),
            ]);
        }

        if (!Hash::check($request->input('old_password'), $user->password)) {
            return response()->json([
                'status' => 400,
                'error' => [
                    'old_password' => ['The old password is incorrect.']
                ],
            ]);
        }

        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return response()->json([
            'status' => 200,
            'msg' => 'Password changed successfully!',
        ]);
    }

    public function updateAddress(Request $request, $id)
    {


        $validator = Validator::make($request->all(), [
            'first_name'=>'required',
            'last_name'=>'required',
            'address' => 'required|string|max:255',
            'country' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'zip' => 'required|string|max:20',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'is_active' => 'nullable|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors(),
            ]);
        }

        $userAddress = UserAddress::where('user_id', Auth::id())->findOrFail($id);

        if ($request->is_active == 'active') {
            UserAddress::where('user_id', Auth::id())
                ->where('is_active', 'active')
                ->where('id', '!=', $userAddress->id) // Exclude the current address being updated
                ->update(['is_active' => 'inactive']);
        }

        // Update the address record
        $userAddress->update([
            'street1' => $request->address,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'zip' => $request->zip,
            'phone' => $request->phone,
            'email' => $request->email,
            'is_active' => $request->is_active ?? 'inactive', // Default to 'inactive' if no value is provided
        ]);

        // Return a response indicating success
        return response()->json([
            'status' => 200,
            'msg' => 'Address updated successfully!',
        ]);
    }

    public function updateProfile(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors(),
            ]);
        }

        // Get the authenticated user
        $user = Auth::user();

        // Update the user's profile
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone;
        $user->save();

        return response()->json([
            'status' => 200,
            'msg' => 'Profile updated successfully.',
        ]);
    }
    public function saveAddress(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_namee'=>'required',
            'last_namee'=>'required',
            'addresss' => 'required|string|max:255',
            'countryy' => 'required|string|max:100',
            'statee' => 'required|string|max:100',
            'cityy' => 'required|string|max:100',
            'zipp' => 'required|max:20',
            'phonee' => 'required|max:20',
            'emaill' => 'required|email|max:255',
            'is_active' => 'nullable|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors(),
            ]);
        }

        if ($request->is_active == 'active') {
            UserAddress::where('user_id', auth()->id())
                ->where('is_active', 'active')
                ->update(['is_active' => 'inactive']);
        }

        $userAddress = new UserAddress();
        $userAddress->user_id = auth()->id();
        $userAddress->street1 = $request->addresss;
        $userAddress->city = $request->cityy;
        $userAddress->state = $request->statee;
        $userAddress->zip = $request->zipp;
        $userAddress->country = $request->countryy;
        $userAddress->phone = $request->phonee;
        $userAddress->email = $request->emaill;
        $userAddress->is_active = $request->is_active ?? 'inactive'; // Default to 'inactive' if not provided

        // Save the new address
        $userAddress->save();

        return response()->json([
            'status' => 200,
            'msg' => 'Address saved successfully!'
        ]);
    }
    public function destroyAddress($id)
    {

        $address = UserAddress::find($id);
        if ($address) {
            $address->delete();
            return redirect()->back()->with('success', 'Address deleted successfully');
        }
        if (!$address) {
            return redirect()->back()->with('error', 'Address not found');
        }
    }
}
