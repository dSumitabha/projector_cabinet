<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class AdminFAQController extends Controller
{
    public function index()
    {
    $faq = Faq::all(); // Fetch all blogs from the database
        return view('admin.pages.faq.index', compact('faq'));
    }

    public function edit($id)
    {
        $blog = Faq::findOrFail($id); // Fetch the blog or throw a 404 if not found
        return view('admin.pages.faq.edit', compact('blog')); // Pass the blog data to the view
    }

    public function update(Request $request, $id)
    {
        $blog = Faq::findOrFail($id); // Find the blog by ID or throw a 404

        $request->validate([

            'question' => 'required|string|max:255', // Title must be unique, excluding the current record
            'answer' => 'required|string',
            'type' => 'required|in:general,product,common',
        ]);







        // Update blog entry
        $blog->update([

            'question' => $request->question,
            'type' => $request->type,
            'answer' => $request->answer,
        ]);

        return redirect()->route('admin.faq')->with('success', 'FAQ updated successfully!');
    }
    public function destroy($id)
    {
        // Find the blog by ID
        $blog = Faq::findOrFail($id);



        // Delete the blog record from the database
        $blog->delete();

        // Redirect to the blogs list with a success message
        return redirect()->route('admin.faq')->with('success', 'FAQ deleted successfully!');
    }

    public function add()
    {
        return view('admin.pages.faq.add-faq'); // Return the view for adding a new blog
    }

    public function store(Request $request)
    {
        $request->validate([

            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'type' => 'required|in:general,product,common',
        ]);



        // Create blog entry
        Faq::create([
            'question' => $request->question,

            'answer' => $request->answer,
            'type' => $request->type,
        ]);

        return redirect()->route('admin.faq')->with('success', 'FAQ added successfully!');
    }

}
