<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PackageProduct;
use App\Imports\PackageProductImport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Exceptions\ExcelException;
class PackagingProductController extends Controller
{
    public function add(Request $request)
    {


        // Pass the fetched parts to the view
        return view('admin.pages.packages.add');
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
        PackageProduct::query()->delete();
        $import = new PackageProductImport();

        try {
            Excel::import($import, $request->file('file'));

            $errors = $import->getErrors();

            if (count($errors) > 0) {
                return redirect()->back()->withErrors($errors)->withInput();
            }

            return redirect()->route('admin.package.index')->with('success', 'Products Packaging imported successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function index(Request $request)
    {
        // Fetch all parts from the database
        $parts = PackageProduct::all();

        // Pass the fetched parts to the view
        return view('admin.pages.packages.view', compact('parts'));
    }

    public function downloadFormat()
    {
        // Path to the template Excel file
        $filePath = public_path('excel_templates/product_packages.xlsx');
        return response()->download($filePath);
    }

    public function destroy($id)
    {
        $data = PackageProduct::findOrFail($id);
        $data->delete();

        return redirect()->route('admin.package.index')->with('success', 'Package Info deleted successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'packaging_product_id' => 'required|string|max:255',
            'package_s_no' => 'required|string|max:255',
            'length_of_package' => 'nullable',
            'width_of_package' => 'nullable',
            'depth_of_package' => 'nullable',
            'weight_of_package' => 'nullable',
        ]);

        $fusion = PackageProduct::findOrFail($id);
        $fusion->update([
            'packaging_product_id' => $request->packaging_product_id,
            'package_s_no' => $request->package_s_no,
            'length_of_package' => $request->length_of_package,
            'width_of_package' => $request->width_of_package,
            'depth_of_package' => $request->depth_of_package,
            'weight_of_package' => $request->weight_of_package,
        ]);

        return redirect()->route('admin.package.index')->with('success', 'Package updated successfully.');
    }
}
