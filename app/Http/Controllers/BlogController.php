<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(12);  // Fetch all blogs from the database

        return view('frontend.blogs.index', compact('blogs'));

    }

    public function details($id, $slug)
    {
        // Retrieve the blog post by its ID and slug
    $blog = Blog::where('id', $id)->where('slugs', $slug)->firstOrFail();

    // Retrieve the previous blog post
    $previousBlog = Blog::where('created_at', '<', $blog->created_at)
                        ->orderBy('created_at', 'desc')
                        ->first();

    // Retrieve the next blog post
    $nextBlog = Blog::where('created_at', '>', $blog->created_at)
                    ->orderBy('created_at', 'asc')
                    ->first();

    // Pass the blog, previousBlog, and nextBlog to the view
    return view('frontend.blogs.details', compact('blog', 'previousBlog', 'nextBlog'));
      
    }
}
