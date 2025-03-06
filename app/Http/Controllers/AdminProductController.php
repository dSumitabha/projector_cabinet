<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductPart;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Imports\ProductImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class AdminProductController extends Controller
{
    public function downloadFormat()
    {
        // Path to the template Excel file
        $filePath = public_path('excel_templates/products.xlsx');
        return response()->download($filePath);
    }
    public function deleteAllImages($product_id)
{
    $product = Product::where('product_id',$product_id)->first();

    if ($product->productImages->isEmpty()) {
        return response()->json(['success' => false, 'message' => 'No images found.']);
    }

    // Delete images from storage
    foreach ($product->productImages as $image) {
        $imagePath = public_path('user/uploads/products/images/' . $image->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $image->delete();
    }

    return response()->json(['success' => true, 'message' => 'All images deleted successfully.']);
}
    public function add()
    {
        return view('admin.pages.products.addproduct');
    }

    public function store(Request $request)
    {
        $request->validate([
            'parent_product_id' => [
                'required_if:product_type,Child Product', // required if product_type is 'Child Product'
                'string'
            ],


            'product_id' => 'required|string|unique:products,product_id',
            'product_name' => 'required|string',
            'product_frontend_name' => 'required|string',
            'product_type' => 'required|string',


        ]);

        Product::create($request->all());

        return response()->json(['message' => 'Product added successfully!'], 200);
    }

    public function index()
    {
        // Fetch all products from the database
        $products = Product::all();

        // Calculate cost_price and selling_price for each product
        foreach ($products as $product) {
            // Fetch and sum up the total cost_price from ProductPart for the product
            $totalCostPrice = ProductPart::where('product_id', $product->product_id)->sum('total');

            // Update cost_price in Product model if totalCostPrice is greater than 0
            if ($totalCostPrice > 0) {
                $product->cost_price = $totalCostPrice;
            }

            // Calculate selling price if cost_price is available
            if ($product->cost_price) {
                if ($product->profit_margin) {
                    // If profit_margin is present, add it to cost_price
                    $product->selling_price = $product->cost_price + $product->profit_margin;
                } elseif ($product->profit_percentage) {
                    // If profit_margin is not present, calculate using profit_percentage
                    $product->selling_price = $product->cost_price + ($product->cost_price * $product->profit_percentage / 100);
                } else {
                    // If neither profit_margin nor profit_percentage is present, set to null
                    $product->selling_price = null;
                }
            } else {
                // If cost_price is missing, set selling_price to null
                $product->selling_price = null;
            }
        }

        // Pass the fetched products to the view
        return view('admin.pages.products.index', compact('products'));
    }

    public function child_index()
    {
        $products = Product::where('parent_product_id', '!=', null)->get();
        return view('admin.pages.products.child_index', compact('products'));
    }
    public function child_product_images_view($id)
    {
        $product = Product::where('product_id', $id)->first();

        return view('admin.pages.products.child_product_images', compact('product'));

    }
    public function child_product_images_store(Request $request)
    {
        $request->validate([
            'images' => 'required', // Validate the image
            'product_id' => 'required', // Ensure the product exists


        ]);
        $uploadedImages = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/user/uploads/products/images');
                $image->move($destinationPath, $imageName);

                // Store each image in the database
                ProductImage::create([
                    'product_id' => $request->product_id,
                    'image' => $imageName,
                ]);

                $uploadedImages[] = $imageName;
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Images uploaded successfully!',
                'uploaded_images' => $uploadedImages,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Image upload failed!',
            ]);
        }
    }
    public function destroy_image($id)
    {
        $data = ProductImage::find($id);

        if (!$data) {

            return redirect()->back()->with('error', 'Image not found.');
        }

        try {
            // Delete the  image
            $oldImage = $data->image;
            if ($oldImage && file_exists(public_path('user/uploads/products/images/' . $oldImage))) {
                unlink(public_path('user/uploads/products/images/' . $oldImage));
            }
            $data->delete();
            return redirect()->back()->with('success', 'Image deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the image.');
        }
    }
    public function update_image(Request $request)
    {
        // Validate input
        $request->validate([
            'image_id' => 'required|exists:product_images,id',


        ]);

        // Ensure that either a file or a YouTube URL is provided, but not both
        if (!$request->hasFile('new_image')) {
            return response()->json([
                'success' => false,
                'message' => 'Please upload an image/video file ',
            ], 422);
        }

        $image = ProductImage::findOrFail($request->image_id);

        // Handle file upload
        if ($request->hasFile('new_image')) {
            // Delete the old image from the public folder
            $oldImagePath = public_path('user/uploads/products/images/' . $image->image);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            // Store the new image
            $newImageName = time() . '_' . uniqid() . '.' . $request->file('new_image')->getClientOriginalExtension();

            $request->file('new_image')->move(public_path('user/uploads/products/images'), $newImageName);

            // Update the image record in the database
            $image->image = $newImageName;

            $image->save();

            // Handle YouTube URL
        }

        return response()->json([
            'success' => true,
            'message' => 'Image/Video updated successfully!',
        ]);
    }
    // Method to fetch product data for editing


    // Method to update product details
    public function update(Request $request)
    {

        $request->validate([
            'parent_product_id' => [
                'required_if:product_type,Child Product', // required if product_type is 'Child Product'
                'string'
            ],

            'product_id' => 'required|string|unique:products,product_id,' . $request->input('product_unique_id'),
            'product_name' => 'required|string',
            'product_type' => 'required|string',

            // Add validation rules for other fields as needed
        ]);

        $product = Product::findOrFail($request->input('product_id'));
        if ($product) {
            $product->parent_product_id = $request->input('parent_product_id');
            $product->fusion_id = $request->input('fusion_id');
            $product->product_center_channel_placement = $request->input('product_center_channel_placement');

            $product->product_id = $request->input('product_unique_id');
            $product->product_frontend_name = $request->input('product_frontend_name');
            $product->product_frontend_description = $request->input('product_frontend_description');
            $product->product_name = $request->input('product_name');
            $product->product_type = $request->input('product_type');
            $product->gs1 = $request->input('gs1');
            $product->gs1_type = $request->input('gs1_type');
            $product->length_of_cabinet = $request->input('length_of_cabinet');
            $product->height_of_cabinet = $request->input('height_of_cabinet');
            $product->depth_of_cabinet = $request->input('depth_of_cabinet');
            $product->diy = $request->input('diy');
            $product->has_doors = $request->input('has_doors');
            $product->profile = $request->input('profile');
            $product->size = $request->input('size');
            $product->color = $request->input('color');



            // Check if cost_price is available
            if ($request->has('profit_margin') || ($request->has('profit_percentage') && $request->input('profit_percentage') > 0)) {
                $cost_price = $product->cost_price;

                if ($cost_price) {
                    $profit_margin = $request->input('profit_margin', null); // Null if not provided
                    $profit_percentage = $request->input('profit_percentage', null); // Null if not provided

                    if (!is_null($profit_margin) && $profit_margin > 0) {
                        // If profit_margin is present and greater than 0, add it directly to cost_price
                        $selling_price = $cost_price + $profit_margin;
                    } elseif (!is_null($profit_percentage) && $profit_percentage > 0) {
                        // If profit_margin is absent, but profit_percentage is present, calculate selling price
                        $selling_price = $cost_price + ($cost_price * $profit_percentage / 100);
                    } else {
                        // If neither profit_margin nor profit_percentage is present, do not update selling_price
                        $selling_price = null;
                    }

                    $product->selling_price = $selling_price; // Set the new selling price
                }

                // Update profit_margin if it's provided
                if ($request->has('profit_margin')) {
                    $product->profit_margin = $profit_margin;
                }

                // Update profit_percentage if it's provided
                if ($request->has('profit_percentage')) {
                    $product->profit_percentage = $profit_percentage;
                }
            }




            // Update other fields as needed
            $product->packaging_product_id = $request->input('packaging_product_id');
            $product->layout_id = $request->input('layout_id');
            $product->render_id = $request->input('render_id');
            $product->off_wall = $request->input('off_wall');
            $product->floor_raising_screen = $request->input('floor_raising_screen');
            $product->depth_of_middle_section = $request->input('depth_of_middle_section');
            $product->depth_of_side_sections = $request->input('depth_of_side_sections');
            $product->center_channel_chamber_length = $request->input('center_channel_chamber_length');
            $product->center_channel_chamber_depth = $request->input('center_channel_chamber_depth');
            $product->center_channel_chamber_height = $request->input('center_channel_chamber_height');
            $product->compatable_with_projectors = $request->input('compatable_with_projectors');
            $product->compatable_with_center_channels = $request->input('compatable_with_center_channels');
            $product->center_channel_placement = $request->input('center_channel_placement');
            $product->variable_height_projector_platform = $request->input('variable_height_projector_platform');
            $product->variable_height_center_channel_platform = $request->input('variable_height_center_channel_platform');
            $product->variable_depth_center_channel_platform = $request->input('variable_depth_center_channel_platform');
            $product->angling_mechanism_for_center_channel = $request->input('angling_mechanism_for_center_channel');
            $product->enclosed_ust_projector = $request->input('enclosed_ust_projector');
            $product->enclosed_center_channel = $request->input('enclosed_center_channel');
            $product->open_back_design = $request->input('open_back_design');
            $product->silent_fan_for_flushing_heat_from_avr = $request->input('silent_fan_for_flushing_heat_from_avr');
            $product->adjustable_height_legs = $request->input('adjustable_height_legs');
            $product->remote_friendly = $request->input('remote_friendly');
            $product->off_wall_cabinet = $request->input('off_wall_cabinet');
            $product->is_floor_raising_screen_embedded_within_cabinet = $request->input('is_floor_raising_screen_embedded_within_cabinet');
            $product->material = $request->input('material');
            $product->installation_required = $request->input('installation_required');

            $product->save();

            return response()->json(['success' => true, 'message' => 'Product updated successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Product not found.'], 404);
        }
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => [
                'required' // Ensure the file is present

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
            // Import the file
            DB::transaction(function () use ($file) {
                Product::query()->delete();
                Excel::import(new ProductImport, $file);
            });
            return redirect()->route('admin.products.index')->with('success', 'Products imported successfully!');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            return back()->withFailures($failures);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            Log::error('File import error: ' . $e->getMessage());
            return back()->withErrors(['file' => 'File upload failed. ' . $e->getMessage()]);
        }
    }
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {

            return redirect()->back()->with('error', 'Product not found.');
        }

        try {
            $product->delete();
            return redirect()->back()->with('success', 'Product deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the product.');
        }
    }


    public function all_delete()
    {
        // Delete all parts
        Product::truncate();

        // Optionally, add a success message to the session
        return redirect()->back()->with('success', 'All Products have been deleted successfully.');
    }
}
