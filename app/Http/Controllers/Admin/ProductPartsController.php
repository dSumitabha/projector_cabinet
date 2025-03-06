<?php

namespace App\Http\Controllers\Admin;

use App\Models\Part;
use App\Models\Product;
use App\Models\ProductPart;
use Illuminate\Http\Request;
use App\Imports\ProductPartImport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ProductPartsController extends Controller
{
    public function downloadFormat()
    {
        // Path to the template Excel file
        $filePath = public_path('excel_templates/product_parts_test.xlsx');
        return response()->download($filePath);
    }
    public function all_delete()
    {
        // Delete all parts
        ProductPart::truncate();

        // Recalculate the cost_price for each product
        $products = Product::all(); // Get all products

        foreach ($products as $product) {
            // Calculate the total cost from all remaining ProductParts for this product
            $totalCostPrice = ProductPart::where('product_id', $product->product_id)->sum('total');

            // Update the cost_price for the product
            $product->cost_price = $totalCostPrice > 0 ? $totalCostPrice : 0;

            // Recalculate the selling price if profit_percentage exists
            if ($product->cost_price && $product->profit_percentage) {
                $product->selling_price = round(
                    $product->cost_price + ($product->cost_price * $product->profit_percentage / 100),
                    2
                );
            } else {
                $product->selling_price = null;
            }

            // Save the updated product
            $product->save();
        }

        // Optionally, add a success message to the session
        return redirect()->back()->with('success', 'All parts have been deleted successfully and cost prices updated.');
    }
    public function index()
    {
        $productParts = ProductPart::all();
        return view('admin.pages.product_parts.index', compact('productParts'));
    }
    public function destroy($id)
    {
        $part = ProductPart::findOrFail($id);

        // Find the associated Product
        $product = Product::where('product_id', $part->product_id)->first();
        $part->delete();
        if ($product) {
            // Calculate the new cost_price
            $totalCostPrice = ProductPart::where('product_id', $product->product_id)->sum('total');
            $product->cost_price = $totalCostPrice;

            // Update the Product with the new cost_price
            $product->save();
        }
        return redirect()->route('admin.product_parts.index')->with('success', ' Product PartDeleted successfully.');
    }
    public function add()
    {
        // Fetch all products
        $products = Product::all();
        $parts = Part::all();
        return view('admin.pages.product_parts.add', compact('products', 'parts'));
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

        try {
            ProductPart::query()->delete();
            // Perform the import
            Excel::import(new ProductPartImport, $request->file('file'));

            // Redirect back with a success message
            return redirect()->route('admin.product_parts.index')->with('success', 'Product parts imported successfully and cost price updated.');

        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            // Handle validation errors
            $failures = $e->failures();
            $validationErrors = [];

            foreach ($failures as $failure) {
                $row = $failure->row(); // The row that has the error
                $attribute = $failure->attribute(); // The attribute that failed
                $errors = $failure->errors(); // The actual error messages

                // Prepare the error message for each failure
                $validationErrors[] = "Row {$row}: Validation failed for '{$attribute}' with error(s): " . implode(', ', $errors);
            }

            // Redirect back with the validation errors
            return redirect()->back()->with('import_error', 'There was an error importing the file.')
                                      ->with('validationErrors', $validationErrors);

        } catch (\Exception $e) {
            // Handle all other exceptions
            return redirect()->back()->with('import_error', 'There was an error importing the file: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {

        // Validate the input
        $request->validate([
            'product_id' => 'required|string|max:255',
            'parts.*.part_id' => 'required|string|max:255',
            'parts.*.total_hours_units' => 'required|numeric',
            'parts.*.total' => 'required|numeric',
        ], [
            'product_id.required' => 'Product ID is required.',
            'parts.*.part_id.required' => 'Part ID is required for each part.',
            'parts.*.total_hours_units.required' => 'Total Number of Hours/Units is required for each part.',
            'parts.*.total.required' => 'Total is required for each part.',
        ]);

        DB::beginTransaction();

        try {
            // Initialize a variable to hold the sum of totals
            $totalCostPrice = 0;
            foreach ($request->parts as $part) {
                $productPart = new ProductPart();
                $productPart->product_id = $request->product_id;
                $productPart->part_id = $part['part_id'];
                $productPart->part_name = $part['part_name'];
                $productPart->part_type = $part['part_type'];
                $productPart->rate = $part['rate'] ?? null;
                $productPart->unit_cost = $part['unit_cost'] ?? null;
                $productPart->total_hours_units = $part['total_hours_units'];
                $productPart->percentage_used = $part['percentage_used'] ?? 100; // Default to 100% if not provided
                $productPart->total = $part['total'];
                // Accumulate the total for cost_price
                $totalCostPrice += $productPart->total;
                $productPart->save();
            }
            // Update the product's cost_price with the total of all parts
            $product = Product::where('product_id', $request->product_id)->first();
            if ($product) {

                // If cost_price already has a value, add the new totalCostPrice to it
                $product->cost_price = ($product->cost_price ?? 0) + $totalCostPrice;
                $product->save();
            }
            DB::commit();

            return redirect()->back()->with('success', 'Product and parts saved successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'An error occurred while saving the data.');
        }
    }
    public function getPartDetails(Request $request)
    {
        $part = Part::where('part_id', $request->part_id)->first();

        if ($part) {
            return response()->json($part);
        } else {
            return response()->json(['error' => 'Part not found'], 404);
        }
    }



    public function edit($id)
    {
        $part = ProductPart::findOrFail($id);
        $products = Product::all(); // Assuming you want to list all products
        $parts = Part::all(); // Assuming you want to list all parts

        return view('admin.pages.product_parts.edit', compact('part', 'products', 'parts'));
    }

    public function update(Request $request, $id)
    {
        $part = ProductPart::findOrFail($id);
        $part->total_hours_units = $request->input('total_hours_units');
        $part->percentage_used = $request->input('percentage_used');
        $part->total = $request->input('total');
        $part->save();
        // Find the associated Product
        $product = Product::where('product_id', $part->product_id)->first();
        if ($product) {
            // Recalculate the total cost_price
            $totalCostPrice = ProductPart::where('product_id', $product->product_id)->sum('total');

            $product->cost_price = $totalCostPrice;
            $product->save();
        }
        return response()->json(['success' => true]);
    }
}
