<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;


class BannerController extends Controller
{
    public function index()
    {
        $data = Banner::all();

        return view('banner.index', ['banners' => $data]);
    }

    public function create()
    {
        return view('banner.create');
    }
    public function add(Request $request)
    {


        //Xu ly up image
        if ($request->hasFile('banerURL'))  //ktra co chon hinh khong
        {
            $file = $request->file('banerURL');

            $ext = $file->getClientOriginalExtension();
            $accept_ext = ['jpg', 'jpeg', 'png', 'gif'];
            if (in_array($ext, $accept_ext)) {
                $size = $file->getSize();
                if ($size <= 2 * 1024 * 1024) {
                    //doi ten hinh lai de up len server
                    $imageName = time() . rand(0, 10000) . '.' .  $file->extension();
                    $file->move(public_path('images'), $imageName);
                } else {
                    $error = 'Image size must be less than 2MB';
                    session()->put('error', $error);
                    return back();
                }
            } else {
                $error = 'Image phai co duoi jpg, jpeg, png, gif';
                session()->put('error', $error);
                return back();
            }
        }

        $action = new Banner();
        $result = $action::create([
            'bannername' => $request->bannername,
            'banerURL' => 'http://localhost:8000/images/' . $imageName
        ]);

        return redirect('banner/index')->with('success',"add banner successfully");
    }


    public function delete($id)
    {
        $banner = Banner::find($id);
        $banner->delete();
        return redirect('/banner/index')->with('success', 'Banner deleted successfully.');
    }
}


