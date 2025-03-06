<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductAssociated;
use App\Models\ProjectorMakeModel;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductAssociatedImport;

class AdminProductAssociatedController extends Controller
{
    public function downloadFormat()
    {
        // Path to the template Excel file
        $filePath = public_path('excel_templates/product_associated.xlsx');
        return response()->download($filePath);
    }
    public function add()
    {
        $uniqueMakes = ProjectorMakeModel::select('make')->distinct()->get();
        return view('admin.pages.products_associated.addproduct', compact('uniqueMakes'));
    }
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'parent_product_id' => 'required|string',

            'projector_make' => 'required|string',
            'projector_model' => 'required|string',
            'projector_platform_slot_from_bottom' => 'nullable|integer',
            'center_channel_slot_from_bottom' => 'nullable|integer',
            'floor_raising_slot_from_bottom' => 'nullable|integer',
            'screen_size' => 'required|integer',
            'ceiling_height' => 'required|integer',
            'distance_of_cabinet_from_screen' => 'nullable|string',
            'distance_of_projector_from_screen' => 'nullable|string',
            'distance_of_top_section_of_screen_from_ceiling' => 'nullable|string',
            'distance_of_bottom_section_of_the_screen_from_floor' => 'nullable|string',
            'distance_of_floor_raising_screen_from_wall' => 'nullable|string',
            'viewing_angle_sitting' => 'nullable|string',

            'viewing_angle_reclining' => 'nullable|string',
            'hearing_angle' => 'nullable|string',



            'center_channel_height' => 'nullable|integer',
            'simulated_center_channel' => 'nullable|string',
            'center_channel_l_clamp_position' => 'nullable|string',
            'max_center_channel_height' => 'nullable|integer',
            'max_center_channel_length' => 'nullable|integer',
            'max_allowed_center_channel_depth' => 'nullable|integer',
            'center_channel_flag' => 'nullable|string',
            'center_channel_tilt_slot' => 'nullable|string',
            'center_channel_tilt_rod_lenth' => 'nullable|string',
        ]);

        // Create a new product using the validated data
        $product = ProductAssociated::create($validatedData);

        return response()->json(['message' => 'Product Association added successfully!', 'product' => $product], 200);
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
        // Delete existing product associations
        ProductAssociated::query()->delete();
        // Initialize the import class
        $import = new ProductAssociatedImport;

        // Perform the import
        Excel::import($import, $request->file('file'));

        // Check for validation failures
        if ($import->failures()->isNotEmpty()) {
            // Pass failures to the session to display in the Blade template
            return redirect()->back()->with('failures', $import->failures());
        }

        // If no failures, pass a success message
        return redirect()->route('admin.products_associated.index')->with('import_success', 'Product associations imported successfully!');
    }
    public function update(Request $request)
    {
        $request->validate([
            'parent_product_id' => 'required|string',

            'projector_make' => 'required|string',
            'projector_model' => 'required|string',
            'projector_platform_slot_from_bottom' => 'nullable|integer',
            'center_channel_slot_from_bottom' => 'nullable|integer',
            'floor_raising_slot_from_bottom' => 'nullable|integer',
            'screen_size' => 'required|integer',
            'ceiling_height' => 'required|integer',
            'distance_of_cabinet_from_screen' => 'nullable|string',
            'distance_of_projector_from_screen' => 'nullable|string',
            'distance_of_top_section_of_screen_from_ceiling' => 'nullable|string',
            'distance_of_bottom_section_of_the_screen_from_floor' => 'nullable|string',
            'distance_of_floor_raising_screen_from_wall' => 'nullable|string',
            'viewing_angle_sitting' => 'nullable|string',

            'viewing_angle_reclining' => 'nullable|string',
            'hearing_angle' => 'nullable|string',

        ]);

        $product = ProductAssociated::findOrFail($request->input('id'));
        if ($product) {
            $product->parent_product_id = $request->input('parent_product_id');

            $product->projector_make = $request->input('projector_make');
            $product->projector_model = $request->input('projector_model');
            $product->projector_platform_slot_from_bottom = $request->input('projector_platform_slot_from_bottom');
            $product->center_channel_slot_from_bottom = $request->input('center_channel_slot_from_bottom');
            $product->floor_raising_slot_from_bottom = $request->input('floor_raising_slot_from_bottom');
            $product->screen_size = $request->input('screen_size');
            $product->ceiling_height = $request->input('ceiling_height');
            $product->distance_of_cabinet_from_screen = $request->input('distance_of_cabinet_from_screen');
            $product->distance_of_projector_from_screen = $request->input('distance_of_projector_from_screen');
            $product->distance_of_top_section_of_screen_from_ceiling = $request->input('distance_of_top_section_of_screen_from_ceiling');
            $product->distance_of_bottom_section_of_the_screen_from_floor = $request->input('distance_of_bottom_section_of_the_screen_from_floor');
            $product->distance_of_floor_raising_screen_from_wall = $request->input('distance_of_floor_raising_screen_from_wall');

            $product->viewing_angle_sitting = $request->input('viewing_angle_sitting');
            $product->viewing_angle_reclining = $request->input('viewing_angle_reclining');

            $product->hearing_angle = $request->input('hearing_angle');
            $product->hearing_angle_reclining = $request->input('hearing_angle_reclining');
            // Update other fields as needed

            $product->center_channel_height = $request->input('center_channel_height');
            $product->simulated_center_channel = $request->input('simulated_center_channel');
            $product->center_channel_l_clamp_position = $request->input('center_channel_l_clamp_position');
            $product->max_center_channel_height = $request->input('max_center_channel_height');
            $product->max_center_channel_length = $request->input('max_center_channel_length');
            $product->max_allowed_center_channel_depth = $request->input('max_allowed_center_channel_depth');
            $product->center_channel_flag = $request->input('center_channel_flag');
            $product->center_channel_tilt_slot = $request->input('center_channel_tilt_slot');
            $product->center_channel_tilt_rod_lenth = $request->input('center_channel_tilt_rod_lenth');

            $product->save();

            return response()->json(['success' => true, 'message' => 'Record updated successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Product not found.'], 404);
        }
    }
    public function index()
    {
        // Fetch all products from the database
        $products = ProductAssociated::all();
        $uniqueMakes = ProjectorMakeModel::select('make')->distinct()->get();
        // Pass the fetched products to the view
        return view('admin.pages.products_associated.index', compact('products', 'uniqueMakes'));
    }

    public function getModels($make)
    {
        $models = ProjectorMakeModel::where('make', $make)->get();
        return response()->json($models);
    }

    public function all_delete()
    {
        // Delete all parts
        ProductAssociated::truncate();

        // Optionally, add a success message to the session
        return redirect()->back()->with('success', 'All Product associateds have been deleted successfully.');
    }
    public function destroy($id)
    {
        $product = ProductAssociated::find($id);

        if (!$product) {

            return redirect()->back()->with('error', 'Record not found.');

        }

        try {
            $product->delete();
            return redirect()->back()->with('success', 'Record deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the product.');
        }
    }
}
