<?php

namespace App\Http\Controllers;

use App\Models\FreeQuote;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function dashboard()

    {
        return view('admin.pages.dashboard');
    }

    public function contactUs()

    {
        $contactUs = FreeQuote::orderBy('created_at', 'desc')->get();
        return view('admin.pages.contact_us.contact_us',compact('contactUs'));
    }

    public function contactUsdelete($id)
    {
        $banner = FreeQuote::findOrFail($id);

        $banner->delete();

        return redirect()->back()->with('success', 'Deleted Successfully');
    }

}
