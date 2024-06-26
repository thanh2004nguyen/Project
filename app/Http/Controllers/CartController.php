<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    // public function index()
    // {
    //     $user = Auth::user();
    //     $cart = $user->cart;
    //     dd($cart);
    //     $items = $cart->items;
    //     return view('pages.cart', compact('items', 'cart'));
    // }



    public function index()
    {

        $id = Session::get('id');
        $user = User::find($id);
        $cart = Cart::fromSession();

        $items = $cart->items;

        $total = $cart->total();
        return view('pages.cart', compact('items', 'cart', 'total'), compact('user'));
    }

    public function addProduct(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Product::find($productId);
        $quantity = $request->input('quantity', 1);
        $cart = Cart::fromSession();
        $cart->addProduct($productId, $quantity, $product->price);
        $cart->save();
        $message = "Product added to cart successfully.";


        return redirect()->back()->with('message', $message);
    }


    public function deleteItem(Product $product)
    {
        $cart = Cart::fromSession();

        $cart->removeProduct($product);
        $cart->save();

        return redirect()->route('cart.index');
    }

    public function updateCart(Request $request, $product_id)
    {
        $cart = Cart::fromSession();

        $itemId = $request->input('quantity');
        // dd($itemId);
        $item = $cart->items()->where('product_id', $product_id)->firstOrFail();
        // dd($item);
        $item->quantity = $itemId;
        $item->save();



        $cart->save();

        return redirect()->route('cart.index');
    }

    public function emptyCart()
    {
        $cart = new Cart();
        $cart->clear();

        return redirect()->back()->with('success', 'Cart emptied successfully!');
    }
    public function showQuantity()
    {
        return Cart::where('user_id', Auth::user()->id)->with('items')->first();
    }


    public function addProductAjax(Request $request)

    {

        $productId = $request->product_id;
        $product = Product::find($productId);
        $quantity = $request->quantity;
        $cart = Cart::fromSession();
        $cart->addProduct($productId, $quantity, $product->price);
        $cart->save();
        $message = "Product added to cart successfully.";


        return Cart::where('user_id', Auth::user()->id)->with('items')->get();
    }
}
