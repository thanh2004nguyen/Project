<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provider;
use Exception;

class ProviderController extends Controller
{

    public function index()
    {

        $providers = Provider::all();
        return view('provider.index', compact('providers'));
    }

    public function create() 
    {
        $providers = Provider::all();
        return view('provider.create', compact('providers'));
    }
    

    public function add(Request $request)
    {
        try {
            $fileName = "";
    
            // Kiểm tra nếu có hình ảnh được gửi lên
            if ($request->hasFile('images')) {
                $file = $request->file('images');
    
                $ext = $file->extension();
                $fileName = time() . '.' . $ext;
                $accept_ext = ['png', 'jpeg', 'jpg', 'gif'];
    
                if (in_array($ext, $accept_ext)) {
                    $size = $file->getSize();
                    // Kiểm tra xem tệp hình ảnh đã được tải lên hay chưa
                    if (!$file->isValid()) {
                        return back()->with('error', 'Hình ảnh tải lên không hợp lệ');
                    }
                    if ($size < 2 * 1024 * 1024) {
                        // Đổi tên hình để lưu lên server
                        $file->move(public_path('img/'), $fileName);
                    } else {
                        return back()->with('error', 'Image phải nhỏ hơn 2MB');
                    }
                } else {
                    return back()->with('error', 'Image phải có đuôi jpg, png, jpeg, gif');
                }
            }
    
            // Tạo mới nhà cung cấp
            $provider = Provider::create([
                
                'name' => $request->name,
                'country' => $request->country,
                'logo' => $fileName
            ]);
            $providers = Provider::all();
            return redirect('provider/index')->with('status', "Create successful");
        } catch (Exception $ex) {
        return back()->with('error', $ex->getMessage());
        }
    }

    public function edit($id)
    {
        $provider = Provider::find($id);
        return view('provider.edit', compact('provider'));
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


            $provider = Provider::find($id);
            $provider->name = $request->name;
            $provider->country = $request->country;
            $provider->logo =  $fileName;
            $provider->save();
        } else {
            $provider = Provider::find($id);
            $provider->name = $request->name;
            $provider->country = $request->country;
            $provider->save();
        }

        return redirect('provider/index')->with('status', "Create successful");
    }
}
