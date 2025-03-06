<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.pages.settings.index', [
            'logo' => Setting::get('logo'),
            'facebook' => Setting::get('facebook'),
            'youtube' => Setting::get('youtube')
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'facebook' => 'nullable|url',
            'youtube' => 'nullable|url'
        ]);

        // Upload Logo
        if ($request->hasFile('logo')) {
            $fileName = 'logo.' . $request->file('logo')->getClientOriginalExtension();
            $path = $request->file('logo')->move(public_path('uploads'), $fileName);
            Setting::set('logo', 'uploads/' . $fileName);
        }

        // Update Social Media Links
        Setting::set('facebook', $request->facebook);
        Setting::set('youtube', $request->youtube);

        return redirect()->back()->with('success', 'Settings updated successfully!');
    }
}
