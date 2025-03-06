<?php

namespace App\Http\Controllers;

use App\Models\SalesRate;
use Illuminate\Http\Request;

class AdminSalesTaxController extends Controller
{
    public function index()
    {
        $salesRates = SalesRate::all();
        return view('admin.pages.sales_rates.index', compact('salesRates'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'rate' => 'required|numeric|min:0', // Ensure rate is valid
        ]);

        $salesRate = SalesRate::findOrFail($id);
        $salesRate->update([
            'rate' => $request->rate,
        ]);

        return response()->json(['success' => 'Rate updated successfully!']);
    }
}
