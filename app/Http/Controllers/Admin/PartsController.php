<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Log;
use App\Models\Part;
use App\Models\Product;
use App\Models\ProductPart;
use App\Imports\PartsImport;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Exceptions\ExcelException;
use Illuminate\Support\Facades\Validator;

class PartsController extends Controller
{

    public function downloadFormat()
    {
        // Path to the template Excel file
        $filePath = public_path('excel_templates/parts_import.xlsx');
        return response()->download($filePath);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => [
                'required'  // Ensure the file is present

            ],
        ], [
            'file.required' => "No file was uploaded. Please upload an Excel (.xlsx, .xls) or CSV (.csv) file.",
        ]);

        // Only retrieve MIME type and extension if the file exists (after validation)
        $file = $request->file('file');

        if ($file) {
            // Get the uploaded file's MIME type and extension
            $fileMimeType = $file->getMimeType();
            $fileExtension = $file->getClientOriginalExtension();

            // If the file passes validation but doesn't match the allowed formats, show an error
            if (!in_array($fileExtension, ['xlsx', 'xls', 'csv'])) {
                return back()->withErrors([
                    'file' => "The uploaded file type ({$fileMimeType}) with extension ({$fileExtension}) is not allowed. Please upload a valid Excel or CSV file.",
                ]);
            }
        }
        Part::query()->delete();
        $import = new PartsImport();

        try {
            Excel::import($import, $request->file('file'));

            $errors = $import->getErrors();

            if (count($errors) > 0) {
                return redirect()->back()->withErrors($errors)->withInput();
            }

            return redirect()->route('admin.parts.index')->with('success', 'Parts imported successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function all_delete()
    {
        // Delete all parts
        Part::truncate();

        // Optionally, add a success message to the session
        return redirect()->back()->with('success', 'All parts have been deleted successfully.');
    }
    public function index(Request $request)
    {
        // Fetch all parts from the database
        $parts = Part::all();

        // Pass the fetched parts to the view
        return view('admin.pages.parts', compact('parts'));
    }
    public function add(Request $request)
    {


        // Pass the fetched parts to the view
        return view('admin.pages.add_parts');
    }
    public function storePart(Request $request)
    {
        $request->validate([
            'part_id' => 'required|unique:parts',
            'part_category' => 'required',
            'part_or_service_name' => 'required',
            'part_type' => 'required',
            'rate' => 'nullable|numeric',
            'unit_cost' => 'nullable|numeric',
            'available_qty' => 'required|integer',
        ]);

        Part::create([
            'part_id' => $request->part_id,
            'part_category' => $request->part_category,
            'part_or_service_name' => $request->part_or_service_name,
            'part_type' => $request->part_type,
            'rate' => $request->rate,
            'batch_cost' => $request->batch_cost,
            'sales_tax' => $request->sales_tax,
            'unit_cost' => $request->unit_cost,
            'url' => $request->url,
            'available_qty' => $request->available_qty,
            'source_company' => $request->source_company,
            'delivery_time' => $request->lead_time,
            'qty' => $request->qty,
            'part_dimensions_length' => $request->part_dimensions_length,
            'part_dimensions_width' => $request->part_dimensions_width,
            'part_dimensions_depth' => $request->part_dimensions_depth,
            'part_dimension_weight' => $request->part_dimension_weight,
            'edge_banding_lf' => $request->edge_banding_lf,
        ]);

        return redirect()->route('admin.parts.index')->with('success', 'Part added successfully!');
    }
    public function edit($id)
    {
        $part = Part::findOrFail($id);
        return response()->json(['part' => $part]);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'part_id' => [
                'required',
                'unique:parts,part_id,' . $id // Ensure part_id is unique in the 'parts' table except for the current record
            ],
            'part_category' => 'required',
            'part_or_service_name' => 'required',
            'part_type' => 'required',
            'rate' => 'nullable|numeric',
            'unit_cost' => 'nullable|numeric',
            'url' => 'nullable|string',
            'available_qty' => 'nullable|integer',
        ]);
     
        $part = Part::findOrFail($id);
        $productIdsToUpdate = []; // Initialize the array to collect product IDs

        // Update the ProductPart model
        $productParts = ProductPart::where('part_id', $part->part_id)->get();

        foreach ($productParts as $productPart) {
            // Calculate the new total based on rate or unit_cost
            $totalHoursUnits = $productPart->total_hours_units;
            $rate = $request->input('rate');
            $unitCost = $request->input('unit_cost');
            $percentageUsed = $productPart->percentage_used / 100;

            if ($rate) {
                $total = $rate * $totalHoursUnits;
            } else {
                $total = $unitCost * $totalHoursUnits;
            }

            $total *= $percentageUsed;

            // Update ProductPart fields and save
            $productPart->part_id = $request->input('part_id');

            $productPart->part_name = $request->input('part_or_service_name');
            $productPart->part_type = $request->input('part_type');
            $productPart->rate = $request->input('rate');
            $productPart->unit_cost = $request->input('unit_cost');
            $productPart->total = $total;
            $productPart->save();

            // Add product_id to the list for cost_price update
            $productIdsToUpdate[] = $productPart->product_id;
        }

        // Update the Part model fields
        $part->part_id = $request->part_id;
        $part->part_category = $request->part_category;
        $part->part_or_service_name = $request->part_or_service_name;
        $part->part_type = $request->part_type;
        $part->rate = $request->rate;
        $part->batch_cost = $request->batch_cost;
        $part->sales_tax = $request->sales_tax;
        $part->unit_cost = $request->unit_cost;
        $part->url = $request->url;
        $part->available_qty = $request->available_qty;
        $part->source_company = $request->source_company;
        $part->delivery_time = $request->lead_time;
        $part->qty = $request->qty;
        $part->part_dimensions_length = $request->part_dimensions_length;
        $part->part_dimensions_width = $request->part_dimensions_width;
        $part->part_dimensions_depth = $request->part_dimensions_depth;
        $part->part_dimension_weight = $request->part_dimension_weight;
        $part->edge_banding_lf = $request->edge_banding_lf;
        $part->save();

        // Check if there are product IDs to update
        if (!empty($productIdsToUpdate)) {
            // Remove duplicate product_ids
            $productIdsToUpdate = array_unique($productIdsToUpdate);

            // Update the cost_price for all affected products
            foreach ($productIdsToUpdate as $productId) {
                $product = Product::where('product_id', $productId)->first();
                if ($product) {
                    $totalCostPrice = ProductPart::where('product_id', $product->product_id)->sum('total');
                    $product->cost_price = $totalCostPrice;
                    $product->save();
                }
            }
        }

        return response()->json(['success' => 'Part updated successfully!']);
    }


    public function destroy($id)
    {
        $part = Part::findOrFail($id);
        $part->delete();

        return redirect()->route('admin.parts.index')->with('success', 'Part deleted successfully.');
    }
}
