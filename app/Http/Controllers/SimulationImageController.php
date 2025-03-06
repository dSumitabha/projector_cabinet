<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SimulationImage;
use App\Models\ProductAssociated;

class SimulationImageController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'parent_product_id' => 'required',
            'projector_make' => 'required',
            'screen_size' => 'required',
            'ceiling_height' => 'required',
            'center_channel_height' => 'required',
            'images.*' => 'required'
        ]);

        foreach ($request->file('images') as $image) {
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('uploads/simulation_images'), $imageName);

            SimulationImage::create([
                'parent_product_id' => $request->parent_product_id,
                'projector_make' => $request->projector_make,
                'screen_size' => $request->screen_size,
                'ceiling_height' => $request->ceiling_height,
                'center_channel_height' => $request->center_channel_height,
                'image_name' => $imageName
            ]);
        }

        return back()->with('success', 'Images uploaded successfully');
    }

    public function fetchImages(Request $request)
    {
        $images = SimulationImage::where([
            'parent_product_id' => $request->parent_product_id,
            'projector_make' => $request->projector_make,
            'screen_size' => $request->screen_size,
            'ceiling_height' => $request->ceiling_height,
            'center_channel_height' => $request->center_channel_height
        ])->get();

        return response()->json($images->map(function ($image) {
            return [
                'id' => $image->id,
                'image_url' => asset('uploads/simulation_images/' . $image->image_name),
            ];
        }));
    }
    public function viewImages(Request $request)
    {
        $productAssociate = ProductAssociated::findOrFail($request->id);

        $images = SimulationImage::where([
            'parent_product_id' => $productAssociate->parent_product_id,
            'projector_make' => $productAssociate->projector_make,
            'screen_size' => $productAssociate->screen_size,
            'ceiling_height' => $productAssociate->ceiling_height,
            'center_channel_height' => $productAssociate->center_channel_height
        ])->get();

        return response()->json(['images' => $images]);
    }
    public function delete($id)
    {
        $image = SimulationImage::findOrFail($id);

        // Delete the file from storage
        $imagePath = public_path('uploads/simulation_images/' . $image->image_name);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $image->delete();

        return response()->json(['message' => 'Image deleted successfully']);
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'image' => 'required'
    ]);

    $image = SimulationImage::findOrFail($id);

    // Delete old image
    if ($image->image_name) {
        $oldImagePath = public_path('uploads/simulation_images/' . $image->image_name);
        if (file_exists($oldImagePath)) {
            unlink($oldImagePath);
        }
    }

    // Upload new image
    $newImage = $request->file('image');
    $imageName = time() . '_' . $newImage->getClientOriginalName();
    $imagePath = 'uploads/simulation_images/' . $imageName;
    $newImage->move(public_path('uploads/simulation_images'), $imageName);

    // Update database
    $image->image_name = $imageName;
    $image->save();

    return response()->json(['success' => true, 'message' => 'Image updated successfully!', 'image_url' => asset($imagePath)]);
}
}
