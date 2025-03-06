<?php

namespace App\Http\Controllers\Admin\Crm\AboutUs;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutUsController extends Controller
{
    // Show the About Us data
    public function index()
    {
        $aboutUs = AboutUs::first(); // Assuming there's only one record for About Us
        return view('admin.pages.about_us.index', compact('aboutUs'));
    }

    // Show the form to edit the About Us content
    public function edit($id)
    {
        $aboutUs = AboutUs::findOrFail($id);
        return view('admin.pages.about_us.edit', compact('aboutUs'));
    }

    // Handle the update of About Us data
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $aboutUs = AboutUs::findOrFail($id);
        $aboutUs->description = $request->description;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('about-us', 'public');
            $aboutUs->image = $path;
        }

        $aboutUs->save();

        return redirect()->route('admin.about-us.index')->with('success', 'About Us updated successfully');
    }
}
