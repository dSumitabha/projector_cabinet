<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminBlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all(); // Fetch all blogs from the database
        return view('admin.pages.blogs.index', compact('blogs'));

    }

    public function add()
    {
        return view('admin.pages.blogs.add-blog'); // Return the view for adding a new blog
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Handle image upload
        $image = $request->file('image');
        $imageName = time() . '_' . preg_replace('/\s+/', '_', $image->getClientOriginalName()); // Unique name for image
        $image->move(public_path('blogs'), $imageName); // Move image to public/blogs directory

        // Generate slug from title
        $slug = Str::slug($request->title, '-'); // Convert title to a slug

        // Create blog entry
        Blog::create([
            'image' => $imageName, // Store only the image name
            'title' => $request->title,
            'slugs' => $slug, // Save the generated slug
            'description' => $request->description,
        ]);

        return redirect()->route('admin.blogs')->with('success', 'Blog added successfully!');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id); // Fetch the blog or throw a 404 if not found
        return view('admin.pages.blogs.edit', compact('blog')); // Pass the blog data to the view
    }
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id); // Find the blog by ID or throw a 404

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'title' => 'required|string|max:255|unique:blogs,title,' . $id, // Title must be unique, excluding the current record
            'description' => 'required|string',
        ]);

        $imageName = $blog->image; // Default to the current image

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if (file_exists(public_path('blogs/' . $blog->image))) {
                unlink(public_path('blogs/' . $blog->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . preg_replace('/\s+/', '_', $image->getClientOriginalName()); // Unique name for image
            $image->move(public_path('blogs'), $imageName); // Move image to public/blogs directory
        }

        // Generate slug from title
        $slug = Str::slug($request->title, '-'); // Convert title to a slug

        // Update blog entry
        $blog->update([
            'image' => $imageName, // Update the image name
            'title' => $request->title,
            'slugs' => $slug, // Update the slug
            'description' => $request->description,
        ]);

        return redirect()->route('admin.blogs')->with('success', 'Blog updated successfully!');
    }


    public function destroy($id)
    {
        // Find the blog by ID
        $blog = Blog::findOrFail($id);

        // Check if the blog has an image and delete it from the public folder
        $imagePath = public_path('blogs/' . $blog->image);  // Get full image path

        if (File::exists($imagePath)) {
            File::delete($imagePath);  // Delete image from the blogs folder in public directory
        }

        // Delete the blog record from the database
        $blog->delete();

        // Redirect to the blogs list with a success message
        return redirect()->route('admin.blogs')->with('success', 'Blog deleted successfully!');
    }
}
