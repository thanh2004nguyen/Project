<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\BlogComment;
use App\Models\BlogImage;
use App\Models\BlogLike;
use App\Models\BlogReplyComment;

class BlogUserController extends Controller
{
    public function index()
    {
        $blog_imgs = BlogImage::all();
    
        $blogs = Blog::all();
        // dd($blogs);
        return view('bloguser', compact('blogs','blog_imgs'));
    }

    public function show($blog_id)
    {
        $blog = Blog::findOrFail($blog_id);
        $blogall = Blog::orderBy('created_at', 'desc')->take(2)->get();
        $images = BlogImage::all();
        return view('single_blog', compact('blog', 'images', 'blogall'));
    }
}
