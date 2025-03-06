<?php

namespace App\Http\Controllers;

use App\Models\AssemblyPart;
use Illuminate\Http\Request;
use App\Imports\AssembleImport;
use Maatwebsite\Excel\Facades\Excel;
class AssemblePartController extends Controller
{
    public function add(Request $request)
    {


        // Pass the fetched parts to the view
        return view('admin.pages.assemble.add');
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
        AssemblyPart::query()->delete();
        $import = new AssembleImport();

        try {
            Excel::import($import, $request->file('file'));

            $errors = $import->getErrors();

            if (count($errors) > 0) {
                return redirect()->back()->withErrors($errors)->withInput();
            }

            return redirect()->route('admin.assemble.index')->with('success', 'Product Assemble Parts imported successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function index(Request $request)
    {
        // Fetch all parts from the database
        $data = AssemblyPart::all();

        // Pass the fetched parts to the view
        return view('admin.pages.assemble.view', compact('data'));
    }

    public function downloadFormat()
    {
        // Path to the template Excel file
        $filePath = public_path('excel_templates/assembly_parts.xlsx');
        return response()->download($filePath);
    }

    public function destroy($id)
    {
        $data = AssemblyPart::findOrFail($id);
        $data->delete();

        return redirect()->route('admin.assemble.index')->with('success', 'Package Info deleted successfully.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'assembly_part_id' => 'required|string|max:255',
            'part_id' => 'required|string|max:255',
            'product_id' => 'nullable',
            'packaging_product_id' => 'required',
            'package_s_no' => 'nullable',
            'qty' => 'nullable',
        ]);

        $fusion = AssemblyPart::findOrFail($id);
        $fusion->update([
            'assembly_part_id' => $request->assembly_part_id,
            'part_id' => $request->part_id,
            'product_id' => $request->product_id,
            'packaging_product_id' => $request->packaging_product_id,
            'package_s_no' => $request->package_s_no,
            'qty' => $request->qty,
        ]);

        return redirect()->route('admin.assemble.index')->with('success', 'Product Assemble Parts updated successfully.');
    }
}
