<?php

namespace App\Http\Controllers;

use App\Models\BlogLike;
use Illuminate\Http\Request;

class BlogLikeController extends Controller
{
    public function handleLike(Request $request)
    {
        $check = BlogLike::where('blog_id', $request->blog_id)->where('user_id', $request->user_id)->first();
        if ($check == null) {
            BlogLike::create([
                'blog_id' => $request->blog_id,
                'user_id' => $request->user_id
            ]);
        } else {
            $check->delete();
        }
    }
}
