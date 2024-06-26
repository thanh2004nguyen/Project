<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogImage;
use Exception;
use Illuminate\Support\Facades\Auth;


class WishlistController extends Controller
{

    // public function index()
    // {
    //     $blogs = Blog::all();
    //     return view('blog.index', compact('blogs'));
    // }

    public function createWishlist($product_id)
    {
        $id = Auth::id();
        $user = User::find($id);
        $wishlist = Wishlist::where('user_id', $id)
            ->where('product_id', $product_id)
            ->get();

        if (count($wishlist) == 0) {
            $wishlist = new Wishlist;
            $wishlist->user_id = $id;
            $wishlist->product_id = $product_id;
            $wishlist->save();
        }


        return redirect()->back();
    }

    public function index()
    {
        $id = Auth::id();
        $user = User::find($id);
        $wishlist = Wishlist::where('user_id', $id)->get();
        foreach ($wishlist as $w) {
            $w['rating'] = product::find($w->product_id)->avgrating();
        }
        // // dd($wishlist);
        // return $wishlist;

        return view('pages.wishlist', compact('wishlist'));
    }
}
