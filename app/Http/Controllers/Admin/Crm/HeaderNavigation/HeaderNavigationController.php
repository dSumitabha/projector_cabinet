<?php

namespace App\Http\Controllers\Admin\Crm\HeaderNavigation;

use App\Http\Controllers\Controller;
use App\Models\HeaderNavigation;
use Illuminate\Http\Request;

class HeaderNavigationController extends Controller
{
    public function index()
    {
        $navigation = HeaderNavigation::all();
        return view('admin.pages.header_navigation.index', compact('navigation'));
    }

    public function add()
    {
        return view('admin.pages.header_navigation.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',

        ]);

        $banner = new HeaderNavigation();
        $banner->title = $request->title;
        $banner->save();

        return redirect()->route('admin.header.navigation')->with('success', 'added successfully');
    }



    public function update(Request $request, $id)
    {

        $request->validate([
            'title' => 'required|string|max:255',
           
        ]);
        $banner = HeaderNavigation::findOrFail($id);

        $banner->title = $request->title;
        $banner->save();

        return redirect()->route('admin.header.navigation')->with('success', 'Updated Successfully');
    }

    public function destroy($id)
    {
        $banner = HeaderNavigation::findOrFail($id);

        $banner->delete();

        return redirect()->back()->with('success', 'Deleted Successfully');
    }
}
