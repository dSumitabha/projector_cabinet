<?php

namespace App\Http\Controllers;

use App\Models\Layout;
use App\Models\FusionFile;
use Illuminate\Http\Request;
use App\Imports\FusionImport;
use App\Imports\LayoutImport;
use Maatwebsite\Excel\Facades\Excel;

class LayoutAttachmentController extends Controller
{
    public function index(Request $request)
    {
        // Fetch all parts from the database
        $data = Layout::all();

        // Pass the fetched parts to the view
        return view('admin.pages.original_layout.view', compact('data'));
    }

    public function add(Request $request)
    {


        // Pass the fetched parts to the view
        return view('admin.pages.original_layout.add');
    }
    public function downloadFormat()
    {
        // Path to the template Excel file
        $filePath = public_path('excel_templates/layouts_test.xlsx');
        return response()->download($filePath);
    }
    public function destroy($id)
    {
        $data = Layout::findOrFail($id);
        $data->delete();

        return redirect()->route('admin.layout.attachment')->with('success', 'Layout deleted successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'layout_id' => 'required|string|max:255',
            'grain_no_grain' => 'required|string|max:255',
            'layout_name' => 'nullable|string|max:255',
            'file_attachment' => 'nullable',
        ]);

        $fusion = Layout::findOrFail($id);
        $fusion->update([
            'layout_id' => $request->layout_id,
            'grain_no_grain' => $request->grain_no_grain,
            'layout_name' => $request->layout_name,
            'file_attachment' => $request->file_attachment,
        ]);

        return redirect()->route('admin.layout.attachment')->with('success', 'Layout updated successfully.');
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
        Layout::query()->delete();
        $import = new LayoutImport();

        try {
            Excel::import($import, $request->file('file'));

            $errors = $import->getErrors();

            if (count($errors) > 0) {
                return redirect()->back()->withErrors($errors)->withInput();
            }

            return redirect()->route('admin.layout.attachment')->with('success', 'Layout Attachments imported successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
}
