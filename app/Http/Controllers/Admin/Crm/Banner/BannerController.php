<?php

namespace App\Http\Controllers\Admin\Crm\Banner;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('admin.pages.banner.index', compact('banners'));
    }

    public function add()
    {
        return view('admin.pages.banner.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_header' => 'required|string|max:255',
            'second_header' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url_link' => 'nullable|url',
        ]);

        $banner = new Banner();
        $banner->first_header = $request->first_header;
        $banner->second_header = $request->second_header;
        $banner->description = $request->description;
        $banner->url_link = $request->url_link;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'admin/upload/images/banner/' . $imageName;

            $image->move(public_path('admin/upload/images/banner'), $imageName);

            $banner->image = $imagePath;
        }

        $banner->save();

        return redirect()->route('admin.banner')->with('success', 'Banner added successfully');
    }



    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        $request->validate([
            'first_header' => 'required|string|max:255',
            'second_header' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url_link' => 'nullable|url',
        ]);

        $banner->first_header = $request->first_header;
        $banner->second_header = $request->second_header;
        $banner->description = $request->description;
        $banner->url_link = $request->url_link;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'admin/upload/images/banner/' . $imageName;

            $image->move(public_path('admin/upload/images/banner'), $imageName);

            if ($banner->image && file_exists(public_path($banner->image))) {
                unlink(public_path($banner->image)); 
            }

            $banner->image = $imagePath;
        }
       // dd($banner);

        $banner->save();

        return redirect()->route('admin.banner')->with('success', 'Banner updated successfully');
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);

        if ($banner->image && file_exists(public_path($banner->image))) {
            unlink(public_path($banner->image));
        }

        $banner->delete();

        return redirect()->back()->with('success', 'Banner deleted successfully');
    }
}
