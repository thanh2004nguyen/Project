<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogImage;
use Exception;
use Illuminate\Support\Facades\Auth;


class BlogController extends Controller
{
    public function homeClient()
    {
        $blog = Blog::orderBy('created_at', 'desc')->with('images')->with('owner')->paginate(6);

        return view('blog')->with('blogs', $blog);
    }

    

    public function index()
    {
        $blogs = Blog::all();
        return view('blog.index', compact('blogs'));
    }

    public function create()
    {

        return view('blog.create');
    }


    public function edit($id)
    {
        $blog = Blog::find($id);
        return view('blog.edit', compact('blog'));
    }

    public function add(Request $request)
    {   
         
        $files = $request->file('images');

       

        $ext = $files->extension();
        $accept_ext = ['png', 'jpeg', 'jpg', 'gif'];
        if (in_array($ext, $accept_ext)) {
            $size = $files->getSize();
            if ($size > 2 * 1024 * 1024) {
                $error = 'image phai nho hon 2MB';

                return back()->with('error', $error);
            }
        } else {
            $error = 'image phai co duoi jpg,png,jpeg,gif';

            return back()->with('error', $error);
        }
    

        // Tạo mới nhà cung cấp

        $blog = new Blog();
        $blog->content = $request->content;
        $blog->user_id = Auth::id();
        $blog->hagtag = $request->hagtag;
        $blog->save();
        if ($request->hasFile('images')) {
$images=$request->file('images');
            
                $imageName = time() . rand(0, 10000) . $images->extension();
                $imageNew = new BlogImage();
                $imageNew->blog_id = $blog->blog_id;
                $imageNew->url = 'http://localhost:8000/productImages/' . $imageName;
                $images->move(public_path('productImages'), $imageName);
                $imageNew->save();
           
        }

        $blogs = Blog::with('images')->get();
        // return $blogs;
        
      
        return redirect('blog/index')->with('status', "Create successful");

        
    }


    public function update(Request $request, $id)
    {
        $fileName = "";
        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $ext = $file->extension();
            $fileName = time() . '.' . $ext;
            $accept_ext = ['png', 'jpeg', 'jpg', 'gif'];
            if (in_array($ext, $accept_ext)) {
                $size = $file->getSize();
                if ($size < 2 * 1024 * 1024) {
                    //doi ten hinh de up len server

                    $file->move(public_path('img/'), $fileName);
                } else {
                    $error = 'image phai nho hon 2MB';
                    return back()->with('error', $error);
                }
            } else {
                $error = 'image phai co duoi jpg,png,jpeg,gif';
                return back()->with('error', $error);
            }


            $blog = Blog::find($id);
            $blog->content = $request->content;
            $blog->user_id = $request->user_id;
            $blog->hagtag = $request->hagtag;
            $blog->save();
        } else {
            $blog = Blog::find($id);
            $blog->content = $request->content;
            $blog->user_id = $request->user_id;
            $blog->hagtag = $request->hagtag;
            $blog->save();
        }

        return redirect('blog/index')->with('status', "Update successful");
    }

    public function delete($id)
    {
        $banner = Blog::find($id);
        $banner->delete();
        return redirect('/blog/index')->with('success', 'Blog deleted successfully.');
    }
}
