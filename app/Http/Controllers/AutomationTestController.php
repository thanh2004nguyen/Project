<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Mail\OrderDetailMail;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\product;
use App\Models\User;
use App\Models\Shipping;
use App\Models\Voucher;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Response;

class AutomationTestController extends Controller
{


public function error()
{   
  
   return view('pages.error');
}
public function confirm_order_allProduct(Request $request){

    try {
        $pdo = DB::connection()->getPdo();
    } catch (\Exception $exception) {
            $errorMessage = 'Oops! Unable to connect to the database. Please try again later.';
            return response()->json(['error' => $errorMessage], Response::HTTP_SERVICE_UNAVAILABLE);
      
    }

    $data = $request;
    // return response($data);
    $user_id = $data['userID'];
    $cart = Cart::where('user_id',$data['userID'])->first();

    $products = product::all();

    if (!$cart) 
    {
    $cart = new Cart();
    $cart->user_id = $user_id;
    $cart->save();
    }

   foreach ($products as $product) {
    $item = new CartItem([
        'product_id' => $product->product_id,
        'quantity' => 1,
        'price' => $product->price
    ]);
    $cart->items()->save($item);
      }
    $data1 = [
        'cart' =>   $cart,
        'item' =>   $item,
    ];
    // return response($data1);
    // Back yo home page if dont have any item on Cart
    $shippingold = Shipping::where('user_id', $data['userID'])->first();
    $user =User::where('id', $data['userID'])->first();
    //  return response($shippingold);
    if(!$shippingold)
    {
        if(!$user->shipping_wardId)
        {
    $provinceName = $request->input('provinceName');
    $districtName = $request->input('dictrictName');
    $wardName = $request->input('warldName');
    $streetname = $request->input('street');
    $address = $provinceName . ', ' . $districtName . ', ' . $wardName . ',' . $streetname;
    $shipping = new Shipping();
    $shipping->shipping_dictrictId =$request->input('district');
    $shipping->shipping_wardId =$request->input('district');
    $shipping->shipping_name =$request->input('name');
    $shipping->shipping_email =$request->input('email');
    $shipping->shipping_phone = $request->input('phone');
    $shipping->shipping_address = $address;
    $shipping->shipping_address_street = $request->input('street');
    $shipping->shipping_method =$request->input('shipping');
    $shipping->shipping_notes =$request->input('deliver-note');
    $shipping->user_id = $data['userID'];
    $shipping->save();
    $shipping_id = $shipping->id;

    // return response($shipping);
    }
    else
    {
            $shipping = new Shipping();
            $shipping->shipping_dictrictId = $user->shipping_dictrictId;
            $shipping->shipping_wardId =  $user->shipping_wardId;
            $shipping->shipping_name =  $user->name;
            $shipping->shipping_email =   $user->email;
            $shipping->shipping_phone = $user->phone;
            $shipping->shipping_address =   $user->address;
            $shipping->shipping_address_street =   $user->shipping_address_street;
            $shipping->shipping_method =$request->input('shipping');
            $shipping->shipping_notes =$request->input('deliver-note');
            $shipping->user_id = $data['userID'];
            $shipping->save();
            $shipping_id = $shipping->id;
            
    }
  }

    else{
        $shipping = new Shipping();
        $shipping->shipping_dictrictId = $shippingold->shipping_dictrictId;
        $shipping->shipping_wardId =  $shippingold->shipping_wardId;
        $shipping->shipping_name =  $shippingold->shipping_name;
        $shipping->shipping_email =   $shippingold->shipping_email;
        $shipping->shipping_phone = $shippingold->shipping_phone;
        $shipping->shipping_address =   $shippingold->shipping_address;
        $shipping->shipping_address_street =   $shippingold->shipping_address_street;
        $shipping->shipping_method =$request->input('shipping');
        $shipping->shipping_notes =$request->input('deliver-note');

    
        $shipping->user_id = $data['userID'];
        $shipping->save();
        $shipping_id = $shipping->id;
    }




    $order = new Order;
    $order->user_id = $data['userID'];
    $order->shipping_id = $shipping_id;
    $order->payment_content = "Thanh Toan Khi Nhan Hang(COD)";

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $order->created_at = now();
    $order->order_date = now();
    $order->save();
    $orderTotal = 0;
    // return response($order);
    foreach($cart->items as $item){

          $product = Product::find($item['product_id']);
           $orderdetails = new OrderDetail;
           $orderdetails->order_id = $order['order_id'];
           $orderdetails->product_id = $item['product_id'];
           $orderdetails->product_name = $product->name;
           $orderdetails->product_price = $item['price'];
           $orderdetails->product_quantity = $item['quantity'];

           if($data['shipping'] == 'High_Speed_delivery')
           {
            $orderdetails->product_feeship = $data['shippingFee'];
           }
           else
           {
            $orderdetails->product_feeship = 0;
           }
           $orderdetails->save();
           $subtotal = $item['price'] * $item['quantity'];
           $orderTotal += $subtotal;
           $sales_count = $product->sales_count;
           $sales_count +=$item['quantity'];
           $product->sales_count= $sales_count;
           $product->save();
           
       }
       $voucherCode = $data['voucherCode'];
       $voucher = Voucher::where('code', $voucherCode )->first();
       if($voucher)
       {
           if( $voucher->is_used === 0)
           {
               $voucher->is_used = 1;
               $voucher->save();
               $order->usedvoucher = $voucherCode;
            
           }
       }


       $feeship =  $orderdetails->product_feeship ;
       $order->order_total = $orderTotal+$feeship;
       $order->order_status = 7;
       $order->save();
       $idss = $data['userID'];
       $user = User::find($idss);  
    
    //    Mail::to($user->email)->send(new OrderDetailMail($user, $order));
   
       $categories = Category::all();

       $productreview =[];
       foreach( $order->orderdetail as $detail)
       {
           $productID = $detail->product_id;
           $productreview[] = Product::where('product_id',$productID)->first();

       }

  

       $request->session()->put('user', $user);
       $request->session()->put('order', $order);
       $request->session()->put('categories', $categories);
       $request->session()->put('productreview', $productreview);
     
       $cart->clear();
       return response( $order);
       return redirect('/review');
    }



public function confirm_order(Request $request){

    try {
        $pdo = DB::connection()->getPdo();
    } catch (\Exception $exception) {
            $errorMessage = 'Oops! Unable to connect to the database. Please try again later.';
            return response()->json(['error' => $errorMessage], Response::HTTP_SERVICE_UNAVAILABLE);
      
    }

    $data = $request->all();
    $user_id = $data['userID'];
    $cart = Cart::where('user_id',$data['userID'])->first();
    if (!$cart) 
    {
    $cart = new Cart();
    $cart->user_id = $user_id;
    $cart->save();
    }
    $randomProduct = Product::inRandomOrder()->first();
    $item = new CartItem([
        'product_id' =>  $randomProduct->product_id,
        'quantity' => 1,
        'price' => $randomProduct->price
    ]);
    // 
    $cart->items()->save($item);

    $shippingold = Shipping::where('user_id', $data['userID'])->first();
    $user =User::where('id', $data['userID'])->first();
    //  return response($shippingold);
    if(!$shippingold)
    {
        if(!$user->shipping_wardId)
        {
    $provinceName = $request->input('provinceName');
    $districtName = $request->input('dictrictName');
    $wardName = $request->input('warldName');
    $streetname = $request->input('street');
    $address = $provinceName . ', ' . $districtName . ', ' . $wardName . ',' . $streetname;
    $shipping = new Shipping();
    $shipping->shipping_dictrictId =$request->input('district');
    $shipping->shipping_wardId =$request->input('district');
    $shipping->shipping_name =$request->input('name');
    $shipping->shipping_email =$request->input('email');
    $shipping->shipping_phone = $request->input('phone');
    $shipping->shipping_address = $address;
    $shipping->shipping_address_street = $request->input('street');
    $shipping->shipping_method =$request->input('shipping');
    $shipping->shipping_notes =$request->input('deliver-note');
    $shipping->user_id = $data['userID'];
    $shipping->save();
    $shipping_id = $shipping->id;

    // return response($shipping);
    }
    else
    {
            $shipping = new Shipping();
            $shipping->shipping_dictrictId = $user->shipping_dictrictId;
            $shipping->shipping_wardId =  $user->shipping_wardId;
            $shipping->shipping_name =  $user->name;
            $shipping->shipping_email =   $user->email;
            $shipping->shipping_phone = $user->phone;
            $shipping->shipping_address =   $user->address;
            $shipping->shipping_address_street =   $user->shipping_address_street;
            $shipping->shipping_method =$request->input('shipping');
            $shipping->shipping_notes =$request->input('deliver-note');
            $shipping->user_id = $data['userID'];
            $shipping->save();
            $shipping_id = $shipping->id;
            
    }
  }

    else{
        $shipping = new Shipping();
        $shipping->shipping_dictrictId = $shippingold->shipping_dictrictId;
        $shipping->shipping_wardId =  $shippingold->shipping_wardId;
        $shipping->shipping_name =  $shippingold->shipping_name;
        $shipping->shipping_email =   $shippingold->shipping_email;
        $shipping->shipping_phone = $shippingold->shipping_phone;
        $shipping->shipping_address =   $shippingold->shipping_address;
        $shipping->shipping_address_street =   $shippingold->shipping_address_street;
        $shipping->shipping_method =$request->input('shipping');
        $shipping->shipping_notes =$request->input('deliver-note');

    
        $shipping->user_id = $data['userID'];
        $shipping->save();
        $shipping_id = $shipping->id;
    }




    $order = new Order;
    $order->user_id = $data['userID'];
    $order->shipping_id = $shipping_id;
    $order->payment_content = "Thanh Toan Khi Nhan Hang(COD)";

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $order->created_at = now();
    $order->order_date = now();
    $order->save();
    $orderTotal = 0;
    // return response($order);
    foreach($cart->items as $item){

          $product = Product::find($item['product_id']);
           $orderdetails = new OrderDetail;
           $orderdetails->order_id = $order['order_id'];
           $orderdetails->product_id = $item['product_id'];
           $orderdetails->product_name = $product->name;
           $orderdetails->product_price = $item['price'];
           $orderdetails->product_quantity = $item['quantity'];

           if($data['shipping'] == 'High_Speed_delivery')
           {
            $orderdetails->product_feeship = $data['shippingFee'];
           }
           else
           {
            $orderdetails->product_feeship = 0;
           }
           $orderdetails->save();
           $subtotal = $item['price'] * $item['quantity'];
           $orderTotal += $subtotal;
           $sales_count = $product->sales_count;
           $sales_count +=$item['quantity'];
           $product->sales_count= $sales_count;
           $product->save();
           
       }
       $voucherCode = $data['voucherCode'];
       $voucher = Voucher::where('code', $voucherCode )->first();
       if($voucher)
       {
           if( $voucher->is_used === 0)
           {
               $voucher->is_used = 1;
               $voucher->save();
               $order->usedvoucher = $voucherCode;
            
           }
       }


       $feeship =  $orderdetails->product_feeship ;
       $order->order_total = $orderTotal+$feeship;
       $order->order_status = 7;
       $order->save();
       $idss = $data['userID'];
       $user = User::find($idss);  
    
    //    Mail::to($user->email)->send(new OrderDetailMail($user, $order));
   
       $categories = Category::all();

       $productreview =[];
       foreach( $order->orderdetail as $detail)
       {
           $productID = $detail->product_id;
           $productreview[] = Product::where('product_id',$productID)->first();

       }

  

       $request->session()->put('user', $user);
       $request->session()->put('order', $order);
       $request->session()->put('categories', $categories);
       $request->session()->put('productreview', $productreview);
     
       $cart->clear();
       return response( $order);
       return redirect('/review');
    }




    public function confirm_order_lostconnect(Request $request){

        try {
                $result = DB::table('invalid_table')->get();
        } catch (\Exception $exception) {
                $errorMessage = 'Oops! Unable to connect to the database. Please try again later.';
                return response()->json(['error' => $errorMessage], Response::HTTP_SERVICE_UNAVAILABLE);
          
        }
    
    
        $data = $request->all();
        $cart = Cart::fromSession();
        // Back yo home page if dont have any item on Cart
        if ($cart->items->count() == 0) {
            $message = 'Have some issue with your checkout!! Please try again!';
            return redirect('/home')->with('message', $message);
        }
    
        $shippingold = Shipping::where('user_id', Session::get('id'))->first();
        $user =User::where('id', Session::get('id'))->first();
    
    
        if(!$shippingold)
        {
            if(!$user->shipping_wardId)
            {
        $provinceName = $request->input('provinceName');
        $districtName = $request->input('dictrictName');
        $wardName = $request->input('warldName');
        $streetname = $request->input('street');
        $address = $provinceName . ', ' . $districtName . ', ' . $wardName . ',' . $streetname;
        $shipping = new Shipping();
        $shipping->shipping_dictrictId =$request->input('district');
        $shipping->shipping_wardId =$request->input('district');
        $shipping->shipping_name =$request->input('name');
        $shipping->shipping_email =$request->input('email');
        $shipping->shipping_phone = $request->input('phone');
        $shipping->shipping_address = $address;
        $shipping->shipping_address_street = $request->input('street');
        $shipping->shipping_method =$request->input('shipping');
    
        $shipping->shipping_notes =$request->input('deliver-note');
        // $shipping->shipping_notes = $data['shipping_notes'];
        // $shipping->shipping_method = $data['shipping_method'];
        $shipping->user_id = Session::get('id');
        $shipping->save();
        $shipping_id = $shipping->id;
        }
        else
        {
                $shipping = new Shipping();
                $shipping->shipping_dictrictId = $user->shipping_dictrictId;
                $shipping->shipping_wardId =  $user->shipping_wardId;
                $shipping->shipping_name =  $user->name;
                $shipping->shipping_email =   $user->email;
                $shipping->shipping_phone = $user->phone;
                $shipping->shipping_address =   $user->address;
                $shipping->shipping_address_street =   $user->shipping_address_street;
                $shipping->shipping_method =$request->input('shipping');
                $shipping->shipping_notes =$request->input('deliver-note');
        
                // $shipping->shipping_notes = $data['shipping_notes'];
                // $shipping->shipping_method = $data['shipping_method'];
                $shipping->user_id = Session::get('id');
                $shipping->save();
                $shipping_id = $shipping->id;
    
        }
      }
    
        else{
            $shipping = new Shipping();
            $shipping->shipping_dictrictId = $shippingold->shipping_dictrictId;
            $shipping->shipping_wardId =  $shippingold->shipping_wardId;
            $shipping->shipping_name =  $shippingold->shipping_name;
            $shipping->shipping_email =   $shippingold->shipping_email;
            $shipping->shipping_phone = $shippingold->shipping_phone;
            $shipping->shipping_address =   $shippingold->shipping_address;
            $shipping->shipping_address_street =   $shippingold->shipping_address_street;
            $shipping->shipping_method =$request->input('shipping');
            $shipping->shipping_notes =$request->input('deliver-note');
    
            // $shipping->shipping_notes = $data['shipping_notes'];
            // $shipping->shipping_method = $data['shipping_method'];
            $shipping->user_id = Session::get('id');
            $shipping->save();
            $shipping_id = $shipping->id;
    
        }
    
        // $checkout_code = substr(md5(microtime()),rand(0,26),5);
    
    
        $order = new Order;
        $order->user_id = Session::get('id');
        $order->shipping_id = $shipping_id;
        $order->payment_content = "Thanh Toan Khi Nhan Hang(COD)";
        // $order->order_code = $checkout_code;
    
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $order->created_at = now();
        $order->order_date = now();
        $order->save();
     
        $orderTotal = 0;
        foreach($cart->items as $item){
    
              $product = Product::find($item['product_id']);
     
               $orderdetails = new OrderDetail;
               $orderdetails->order_id = $order['order_id'];
               $orderdetails->product_id = $item['product_id'];
               $orderdetails->product_name = $product->name;
               $orderdetails->product_price = $item['price'];
               $orderdetails->product_quantity = $item['quantity'];
    
               if($data['shipping'] == 'High_Speed_delivery')
               {
                $orderdetails->product_feeship = $data['shippingFee'];
               }
               else
               {
                $orderdetails->product_feeship = 0;
               }
               $orderdetails->save();
               $subtotal = $item['price'] * $item['quantity'];
               $orderTotal += $subtotal;
               $sales_count = $product->sales_count;
               $sales_count +=$item['quantity'];
               $product->sales_count= $sales_count;
               $product->save();
               
           }
           $voucherCode = $data['voucherCode'];
           $voucher = Voucher::where('code', $voucherCode )->first();
           if($voucher)
           {
               if( $voucher->is_used === 0)
               {
                   $voucher->is_used = 1;
                   $voucher->save();
                   $order->usedvoucher = $voucherCode;
                
               }
           }

               
           $feeship =  $orderdetails->product_feeship ;
           $order->order_total = $orderTotal+$feeship;
           $order->order_status = 7;
           $order->save();
           $idss = Session::get('id');
           $user = User::find($idss); 

           $cart->clear();
           return response($feeship);

           Mail::to($user->email)->send(new OrderDetailMail($user, $order));
           $categories = Category::all();
    
           $productreview =[];
           foreach( $order->orderdetail as $detail)
           {
               $productID = $detail->product_id;
               $productreview[] = Product::where('product_id',$productID)->first();
    
           }
    
        
           return redirect('/review');
        }

        public function confirm_order_cart_empty(Request $request){

            try {
                $pdo = DB::connection()->getPdo();
            } catch (\Exception $exception) {
                    $errorMessage = 'Oops! Unable to connect to the database. Please try again later.';
                    return response()->json(['error' => $errorMessage], Response::HTTP_SERVICE_UNAVAILABLE);
              
            }
        
            // check if cart empty -> back to homepage with message
            $cart = Cart::where('user_id',123)->first();
            if (!$cart) 
            {
            $cart = new Cart();
            $cart->user_id = 123;
            $cart->save();
            }
            // Back yo home page if dont have any item on Cart
            if($cart->items->count() == 0) 
            {
                $message ='Have some issue with your checkout!! Please try again!';
                return response( $message);
            }
            $data = $request;
            $user_id = $data['userID'];
            $cart = Cart::where('user_id',$data['userID'])->first();
            if (!$cart) 
            {
            $cart = new Cart();
            $cart->user_id = $user_id;
            $cart->save();
            }
        
            $item = new CartItem([
                'product_id' => 1,
                'quantity' => 1,
                'price' => 11669
            ]);
            // return response($item);
            $cart->items()->save($item);
            $data1 = [
                'cart' =>   $cart,
                'item' =>   $item,
            ];
            // return response($data1);
            // Back yo home page if dont have any item on Cart
            $shippingold = Shipping::where('user_id', $data['userID'])->first();
            $user =User::where('id', $data['userID'])->first();
            //  return response($shippingold);
            if(!$shippingold)
            {
                if(!$user->shipping_wardId)
                {
            $provinceName = $request->input('provinceName');
            $districtName = $request->input('dictrictName');
            $wardName = $request->input('warldName');
            $streetname = $request->input('street');
            $address = $provinceName . ', ' . $districtName . ', ' . $wardName . ',' . $streetname;
            $shipping = new Shipping();
            $shipping->shipping_dictrictId =$request->input('district');
            $shipping->shipping_wardId =$request->input('district');
            $shipping->shipping_name =$request->input('name');
            $shipping->shipping_email =$request->input('email');
            $shipping->shipping_phone = $request->input('phone');
            $shipping->shipping_address = $address;
            $shipping->shipping_address_street = $request->input('street');
            $shipping->shipping_method =$request->input('shipping');
            $shipping->shipping_notes =$request->input('deliver-note');
            $shipping->user_id = $data['userID'];
            $shipping->save();
            $shipping_id = $shipping->id;
        
            // return response($shipping);
            }
            else
            {
                    $shipping = new Shipping();
                    $shipping->shipping_dictrictId = $user->shipping_dictrictId;
                    $shipping->shipping_wardId =  $user->shipping_wardId;
                    $shipping->shipping_name =  $user->name;
                    $shipping->shipping_email =   $user->email;
                    $shipping->shipping_phone = $user->phone;
                    $shipping->shipping_address =   $user->address;
                    $shipping->shipping_address_street =   $user->shipping_address_street;
                    $shipping->shipping_method =$request->input('shipping');
                    $shipping->shipping_notes =$request->input('deliver-note');
                    $shipping->user_id = $data['userID'];
                    $shipping->save();
                    $shipping_id = $shipping->id;
                    
            }
          }
        
            else{
                $shipping = new Shipping();
                $shipping->shipping_dictrictId = $shippingold->shipping_dictrictId;
                $shipping->shipping_wardId =  $shippingold->shipping_wardId;
                $shipping->shipping_name =  $shippingold->shipping_name;
                $shipping->shipping_email =   $shippingold->shipping_email;
                $shipping->shipping_phone = $shippingold->shipping_phone;
                $shipping->shipping_address =   $shippingold->shipping_address;
                $shipping->shipping_address_street =   $shippingold->shipping_address_street;
                $shipping->shipping_method =$request->input('shipping');
                $shipping->shipping_notes =$request->input('deliver-note');
        
            
                $shipping->user_id = $data['userID'];
                $shipping->save();
                $shipping_id = $shipping->id;
            }
        
        
        
        
            $order = new Order;
            $order->user_id = $data['userID'];
            $order->shipping_id = $shipping_id;
            $order->payment_content = "Thanh Toan Khi Nhan Hang(COD)";
        
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $order->created_at = now();
            $order->order_date = now();
            $order->save();
            $orderTotal = 0;
            // return response($order);
            foreach($cart->items as $item){
        
                  $product = Product::find($item['product_id']);
                   $orderdetails = new OrderDetail;
                   $orderdetails->order_id = $order['order_id'];
                   $orderdetails->product_id = $item['product_id'];
                   $orderdetails->product_name = $product->name;
                   $orderdetails->product_price = $item['price'];
                   $orderdetails->product_quantity = $item['quantity'];
        
                   if($data['shipping'] == 'High_Speed_delivery')
                   {
                    $orderdetails->product_feeship = $data['shippingFee'];
                   }
                   else
                   {
                    $orderdetails->product_feeship = 0;
                   }
                   $orderdetails->save();
                   $subtotal = $item['price'] * $item['quantity'];
                   $orderTotal += $subtotal;
                   $sales_count = $product->sales_count;
                   $sales_count +=$item['quantity'];
                   $product->sales_count= $sales_count;
                   $product->save();
                   
               }
               $voucherCode = $data['voucherCode'];
               $voucher = Voucher::where('code', $voucherCode )->first();
               if($voucher)
               {
                   if( $voucher->is_used === 0)
                   {
                       $voucher->is_used = 1;
                       $voucher->save();
                       $order->usedvoucher = $voucherCode;
                    
                   }
               }
        
        
               $feeship =  $orderdetails->product_feeship ;
               $order->order_total = $orderTotal+$feeship;
               $order->order_status = 7;
               $order->save();
               $idss = $data['userID'];
               $user = User::find($idss);  
            
            //    Mail::to($user->email)->send(new OrderDetailMail($user, $order));
           
               $categories = Category::all();
        
               $productreview =[];
               foreach( $order->orderdetail as $detail)
               {
                   $productID = $detail->product_id;
                   $productreview[] = Product::where('product_id',$productID)->first();
        
               }
        
          
        
               $request->session()->put('user', $user);
               $request->session()->put('order', $order);
               $request->session()->put('categories', $categories);
               $request->session()->put('productreview', $productreview);
             
               $cart->clear();
               return response( $order);
               return redirect('/review');
            }

}





