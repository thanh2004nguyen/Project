<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\product;

use Illuminate\Http\Request;
use App\Models\Provider;
use App\Models\Category;


class ProductController extends Controller
{
    public function all_product()
    {
        $product = product::with('images')->with('provider')->with('category')->get();


        return view('admin.product.index')->with('product', $product);
    }


    public function all_product_user()
    {

        $product = product::with('images')->with('provider')->with('review')->paginate(9);

        $provider = Provider::all();
        $category = Category::all();
        // return $product;
        return view('client.category')->with('products', $product)->with('providers', $provider)->with('categories', $category);
    }

    public function sort__products(Request $request)
    {

        $data = product::query();

        if ((int)($request->price) > 0) {

            $data->where('price', '>=', (int)($request->price))->where('price', '<=', (int)($request->price + 5));
        }

        if (isset($request->provider)) {


            $data->whereIn('provider_id', $request->provider);
        }


        if (isset($request->type)) {

            $data->whereIn('category_id', $request->type);
        }

        if (isset($request->sort)) {
            if ($request->sort == "Bestseller") {
                $data->orderBy('quantity', 'desc');
            }
            if ($request->sort == "price_asc") {
                $data->orderBy('price', 'asc');
            }
            if ($request->sort == "price_desc") {
                $data->orderBy('price', 'desc');
            }
        }


        return $data->with('images')->with('review')->get();
    }


    public function edit_product($id)
    {

        $product = Product::where('product_id', $id)->with('images')->first();
        $provider = Provider::all();
        $category = Category::all();



        return view('admin.product.edit')->with('product', $product)->with('provider', $provider)->with('categories', $category);
    }

    public function update_product(Request $request, $id)
    {
        $product = Product::find($id);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {

                $ext = $file->extension();
                $accept_ext = ['png', 'jpeg', 'jpg', 'gif'];
                if (in_array($ext, $accept_ext)) {
                    $size = $file->getSize();
                    if ($size < 2 * 1024 * 1024) {
                        //doi ten hinh de up len server


                    } else {
                        $error = 'image phai nho hon 2MB';
                        return back()->with('error', $error);
                    }
                } else {
                    $error = 'image phai co duoi jpg,png,jpeg,gif';
                    return back()->with('error', $error);
                }
            }
        }


        if (isset($request->imagesDelete)) {
            foreach ($request->imagesDelete as $d) {
                Image::find((int)$d)->delete();
            }
        }

        if (isset($request->images)) {
            $files = $request->file('images');
            foreach ($files  as $item) {
                $imageName = time() . rand(0, 10000) . '.' . $item->extension();
                $item->move(public_path('productImages'), $imageName);
                Image::create(
                    [
                        'url' => 'http://localhost:8000/productImages/' . $imageName,
                        'product_id' => $id
                    ]
                );
            }
        }




        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->provider_id = $request->provider_id;
        $product->category_id = $request->category_id;
        $product->save();
        return redirect('/admin/product/index')->with('message', 'Update Product Successful');
    }


    public function create()
    {

        $provider = Provider::all();
        $category = Category::all();

        return view('admin.product.add_product')->with('providers', $provider)->with('categories', $category);
    }

    public function add_product(Request $request)
    {


        $file = $request->file('images');

        foreach ($file as $files) {

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
        }


        $product = new Product();

        $product->name = $request->name;
        $product->description =   $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category;
        $product->provider_id = $request->provider_id;
        $product->quantity = $request->quantity;

        $product->save();


        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $image) {
                $imageName = time() . rand(0, 10000) . $image->extension();
                $imageNew = new Image();
                $imageNew->product_id = $product->product_id;
                $imageNew->url = 'http://localhost:8000/productImages/' . $imageName;
                $image->move(public_path('productImages'), $imageName);
                $imageNew->save();
            }
        }
        return redirect('/admin/product/index')->with('message', 'Add Product Successful');
    }
}
