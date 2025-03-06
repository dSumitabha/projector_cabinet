<?php

namespace App\Http\Controllers;

use App\Models\FusionFile;
use Illuminate\Http\Request;
use App\Imports\FusionImport;
use Maatwebsite\Excel\Facades\Excel;

class FusionFileController extends Controller
{
    public function index(Request $request)
    {
        // Fetch all parts from the database
        $data = FusionFile::all();

        // Pass the fetched parts to the view
        return view('admin.pages.layout.view', compact('data'));
    }

    public function add(Request $request)
    {


        // Pass the fetched parts to the view
        return view('admin.pages.layout.add');
    }
    public function destroy($id)
    {
        $fusion = FusionFile::findOrFail($id);
        $fusion->delete();

        return redirect()->route('admin.fusion.attachment')->with('success', 'Fusion deleted successfully.');
    }
    public function downloadFormat()
    {
        // Path to the template Excel file
        $filePath = public_path('excel_templates/fusion_attachment.xlsx');
        return response()->download($filePath);
    }
    public function update(Request $request, $id)
{
    $request->validate([
        'fusion_id' => 'required|string|max:255',
        'file_name' => 'nullable|string|max:255',
        'file_attachment' => 'nullable',
    ]);

    $fusion = FusionFile::findOrFail($id);
    $fusion->update([
        'fusion_id' => $request->fusion_id,
        'file_name' => $request->file_name,
        'file_attachment' => $request->file_attachment,
    ]);

    return redirect()->route('admin.fusion.attachment')->with('success', 'Fusion updated successfully.');
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
        FusionFile::query()->delete();
        $import = new FusionImport();

        try {
            Excel::import($import, $request->file('file'));

            $errors = $import->getErrors();

            if (count($errors) > 0) {
                return redirect()->back()->withErrors($errors)->withInput();
            }

            return redirect()->route('admin.fusion.attachment')->with('success', 'Fusion Attachments imported successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
}
