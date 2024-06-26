<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Cart;
use App\Models\product;
use App\Models\Provider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Blog;
use App\Models\View;

class HomeController extends Controller
{
    //
    public function index()
    {
    
        if (Auth::id()) {
            $is_admin = Auth()->user()->is_admin;
            if ($is_admin == 0) {
                return redirect('/');
            } else if ($is_admin == 1) {
                return redirect('/admin');
            }
        } 
    }

    public function home()
    {
        $blog=Blog::with('images')->get();
        // return $blog;
        $brands = Provider::get();
        $banner = Banner::get();
        // return $brands;
        $newProducts = product::all()->sortByDesc('created_at')->take(6);
        //    return $newProducts;
        $topProducts = product::orderBy('sales_count', 'desc')
            ->take(6)
            ->get();
            return view('dashboard', compact('brands','blog', 'newProducts', 'topProducts','banner'));
    }

    public function about()
    {
     return view('pages.aboutUs');
    }




    public function productDetail($id)
    {
        if (Auth::user()) {
            view::create([
                'user_id' => Auth::user()->id,
                'product_id' => $id
            ]);
        } else {
            view::create([
                'user_id' => null,
                'product_id' => $id
            ]);
        }
        $product = product::with(['images'])->findOrFail($id);
        // return $product;


        $relatePro = product::where('provider_id', $product->provider_id)
            ->where('product_id', '<>', $id)->with('images')
            ->take(5)
            ->get();
        // return $relatePro;
        return view('pages.productdetail', compact('product', 'relatePro'));
    }


         //    check email
         public function checkEmail(Request $request)
         {
             $email = $request->input('email');
             $exists = User::where('email', $email)->exists();
             return response()->json(['exists' => $exists]);
         }
         
}
