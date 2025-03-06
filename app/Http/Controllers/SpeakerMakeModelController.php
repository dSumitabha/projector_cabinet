<?php

namespace App\Http\Controllers;

use App\Models\Speaker;
use Illuminate\Http\Request;

class SpeakerMakeModelController extends Controller
{
    public function index()
    {
        $data = Speaker::all();

        return view('admin.pages.speakers', compact('data'));
    }

    public function store(Request $request)
{
    // Validate the form data
    $validatedData = $request->validate([
        'brand' => 'required|string|max:255',
        'model.*' => 'required|string|max:255',
        'release_year.*' => 'required|integer',
        'height.*' => 'required|numeric',
        'width.*' => 'required|numeric',
        'depth.*' => 'required|numeric',
    ]);

    // Loop through each model and store it in the database
    for ($i = 0; $i < count($validatedData['model']); $i++) {
        Speaker::create([
            'brand' => $validatedData['brand'],
            'model' => $validatedData['model'][$i],
            'release_year' => $validatedData['release_year'][$i],
            'height' => $validatedData['height'][$i],
            'width' => $validatedData['width'][$i],
            'depth' => $validatedData['depth'][$i],
        ]);
    }

    // Return a success message
    return response()->json(['success' => true, 'message' => 'Speakers added successfully.']);
}


public function update(Request $request, $id)
{
    $speaker = Speaker::findOrFail($id);
    $speaker->update($request->all());

    return response()->json(['success' => true, 'message' => 'Speaker updated successfully.']);
}
public function destroy($id)
{
    $data = Speaker::find($id);
    if ($data) {
        $data->delete();
        return redirect()->route('admin.speakers.index')->with('success', 'Record deleted successfully');
    } else {
        return redirect()->route('admin.speakers.index')->with('error', 'Record not found');
    }
}
}
