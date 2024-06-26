<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartCheckoutRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;



use App\Http\Requests\CheckoutRequest;
use App\Mail\OrderDetailMail;
use App\Mail\VoucherEmail;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Review;
use App\Models\StatisProduct;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\Shipping;
use App\Models\Voucher;

class CheckoutController extends Controller
{
    //
    public function index(CartCheckoutRequest $request){
        $userID = Auth::id();

        try {
            $user = User::find($userID);
        } catch (\Exception $exception) {
            return response()->view('pages.error', [], 401);
        }

        $cart = Cart::fromSession();
        $items = $cart->items;
        $shipping = Shipping::where('user_id', $userID)
        ->orderBy('created_at', 'desc')
        ->first();

        // dd($items);
        $total=$cart->total();
        return view('pages.checkout',compact('cart','items','total','shipping','user'));
     }

//  create voucher code
     public function generateVoucherCode()
{
    $length = 8;
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    
    do {
        $voucherCode = '';
        for ($i = 0; $i < $length; $i++) {
            $voucherCode .= $characters[rand(0, strlen($characters) - 1)];
        }

        $existingVoucher = Voucher::where('code', $voucherCode)->first();
    } while ($existingVoucher);
    
    return $voucherCode;
}

// send email that have voucher for user
public function sendVoucherEmail($email, $voucherCode)
{
 
    Mail::to($email)->send(new VoucherEmail($voucherCode));
}


public function sendMail()
    {
        $data = array('name'=>"Customer");
        Mail::send('mail', $data, function($message) {
            $message->from('huyhie1989@gmail.com','TREE ONE');
            $message->to('huyhien1989@gmail.com', 'Customer');
            $message->subject('TREE ONE TEAM');
        });
        echo "HTML Email Sent. Check your inbox.";
    }


    public function confirm_order(CheckoutRequest $request){
  
        try {
            $pdo = DB::connection()->getPdo();
        } catch (\Exception $exception) {
                $errorMessage = 'Oops! Unable to connect to the database. Please try again later.';
                return response()->json(['error' => $errorMessage], Response::HTTP_SERVICE_UNAVAILABLE);
          
        }
        $id = Auth::id();
        try {
            $user = User::find($id);
        } catch (\Exception $exception) {
            Session::put('message','Xóa Danh Mục sản phẩm thành công');
            return redirect('/error')->with('message','Database connection error')->withInput();
        }

        $data = $request->all();
        // dd($data);

        $cart = Cart::fromSession();
        // Back yo home page if dont have any item on Cart
        if($cart->items->count() == 0) 
        {
           return redirect('/home')->with('message','Have some issue with your checkout!! Please try again!');
        }

        $shippingold = Shipping::where('user_id', Auth::id())->first();
        $user =User::where('id', Auth::id())->first();
    

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
        $shipping->shipping_wardId =$request->input('ward');
        $shipping->shipping_name =$request->input('name');
        $shipping->shipping_email =$request->input('email');
        $shipping->shipping_phone = $request->input('phone');
        $shipping->shipping_address = $address;
        $shipping->shipping_address_street = $request->input('street');
        $shipping->shipping_method =$request->input('shipping');

        $shipping->shipping_notes =$request->input('deliver-note');
        // $shipping->shipping_notes = $data['shipping_notes'];
        // $shipping->shipping_method = $data['shipping_method'];
        $shipping->user_id = Auth::id();
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
                $shipping->user_id = Auth::id();
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
            $shipping->user_id = Auth::id();
            $shipping->save();
            $shipping_id = $shipping->id;

        }

        // $checkout_code = substr(md5(microtime()),rand(0,26),5);
   

        $order = new Order;
        $order->user_id = Auth::id();
        $order->shipping_id = $shipping_id;
        $order->payment_content = "COD";
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
                 if(!$orderdetails)
                 {
                    return redirect('/home')->with('error','Have some issue with your checkout!! Please try again!');
                 }
           $feeship =  $orderdetails->product_feeship ;
           $order->order_total = $orderTotal+$feeship;
           $order->order_status = 7;
           $order->save();
           $idss = Auth::id();
           $user = User::find($idss);  
           Mail::to($user->email)->send(new OrderDetailMail($user, $order));
           $providers = Provider::all();

           $productreview =[];
           foreach( $order->orderdetail as $detail)
           {
               $productID = $detail->product_id;
               $productreview[] = Product::where('product_id',$productID)->first();

           }

       

           $request->session()->put('user', $user);
           $request->session()->put('order', $order);
           $request->session()->put('providers', $providers);
           $request->session()->put('productreview', $productreview);
           $cart->clear();
           return redirect('/home')->with('message', 'Order successfully! Thanks');
        }

        public function vnPayCheck(Request $request)
        {
            //1. Lay data tu URL (do VNPay gui ve qua $vnp_ReturnUrl)
            $vnp_ResponseCode = $request->get('vnp_ResponseCode'); //Ma phan hoi ket qua thanh toan
            $vnp_TxnRef = $request->get('vnp_TxnRef'); //ticket_id
            $vnp_Amount = $request->get('vnp_Amount'); //so tien thanh toan
    
            //2. Kiem tra ket qua giao dich tra ve tu VNPay
            if ($vnp_ResponseCode !=null)
            {
                //neu thanh cong
                if ($vnp_ResponseCode == 00)
                {
                     $data = $request->all();
                    //  dd($data);
                     $userID = Auth::id();

                 // Retrieve the newest order for the user
                         $order = Order::where('user_id', $userID)
                          ->orderBy('created_at', 'desc')
                          ->first();
                        // $voucherCode = $order->usedvoucher;
                        $voucher = Voucher::where('code', $order->usedvoucher)->first();
                        if($voucher)
                        {
                            if( $voucher->is_used === 0)
                            {
                                $voucher->is_used = 1;
                                $voucher->save();
                            }
                        }
                          $vnp_Amount = $request->input('vnp_Amount');
                          $vnp_OrderInfo = $request->input('vnp_OrderInfo');
                          $vnp_PayDate = $request->input('vnp_PayDate');
                          $vnp_Amountreal =  $vnp_Amount/100;
                          $vnp_TxnRef = $request->get('vnp_TxnRef');
                      
                          $payment_content ='Order ID:' .  $vnp_TxnRef . ',' .  'Total' .  ':' . $vnp_Amountreal . 'VND' . ', ' . 'Order info:' .  $vnp_OrderInfo . ', ' .  'Pay Date:' . $vnp_PayDate;
                 $cart = Cart::fromSession();
                 $order->order_status = 1;
                 $order->payment_content =  $payment_content;
                 $order->save();

                 if($vnp_Amount >50000000)
                 {
                  $voucherCode = $this->generateVoucherCode();
                  $expirationDate = now()->addDays(30);
  
                  // Create voucher record
                  $voucher = new Voucher();
                  $voucher->code = $voucherCode;
                  $voucher->type = 1;
                  $voucher->name = "30k Voucher";
                  $voucher->discount = 30000;
                  $voucher->discounttype = 1;
                  $voucher->user_id = Auth::id();
                  $voucher->expiration_date = $expirationDate;
                  $id=Auth::id();
                  $voucher->save();
              
                  // Send voucher code to user via email
                  $user = User::find($id);
                  $userEmail = $user->email;
                  $this->sendVoucherEmail($userEmail, $voucherCode);


  
                 }
                 $id=Auth::id();
                 $user = User::find($id);
                 Mail::to($user->email)->send(new OrderDetailMail($user, $order));
                 $cart->clear();
                    return redirect('/home')->with('message','Paid sucessfully');
                }
                else
                {
                    return "Failed payment";
                }
            }
        }
    
    
        public function vnpay_payment(CheckoutRequest $request)
        {
            $data = $request->all();
            $cart = Cart::fromSession();
            // Back yo home page if dont have any item on Cart
            if($cart->items->count() == 0) 
            {
               return redirect('/home')->with('error','Have some issue with your checkout!! Please try again!');
            }

            $user =User::where('id', Auth::id())->first();
            // dd($data);
            $shippingold = Shipping::where('user_id',Auth::id())->first();
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
            $shipping->shipping_dictrictId = $data['district'];
            $shipping->shipping_wardId = $data['ward'];
            $shipping->shipping_name = $data['name'];
            $shipping->shipping_name = $data['name'];
            $shipping->shipping_email = $data['email'];
            $shipping->shipping_phone = $data['phone'];
            $shipping->shipping_address = $address;
            $shipping->shipping_method = $data['shipping'];
            $shipping->shipping_notes = $data['deliver-note'];
            $shipping->shipping_address_street = $data['street'];
            $shipping->user_id = Auth::id();
            $shipping->save();
            $shipping_id = $shipping->id;
            }
            else{
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
                $shipping->user_id = Auth::id();
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
                $shipping->shipping_method = $data['shipping'];
                $shipping->shipping_notes = $data['deliver-note'];
        
                // $shipping->shipping_notes = $data['shipping_notes'];
                // $shipping->shipping_method = $data['shipping_method'];
                $shipping->user_id =Auth::id();
                $shipping->save();
                $shipping_id = $shipping->id;
            }

            $voucherCode = $data['voucherCode'];
            // CHANGE VOUCHER TO USED (1)
            $order = new Order;
            $voucher = Voucher::where('code', $voucherCode )->first();
            if($voucher){

                if( $voucher->is_used === 0)
                {
                    $voucher->save();
                    $order->usedvoucher = $voucherCode;
                }
                
            }
 
    
            $order->user_id =Auth::id();
            $order->shipping_id = $shipping_id;
            $order->order_status = 6;
            $order->payment_content ="payment is not completed";
            // $order->order_code = $checkout_code;
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $order->created_at = now();
            $order->order_date = now();
            $order->save();
            $orderID = $order->order_id;
            $orderTotal = 0;
            foreach($cart->items as  $item){
                  $product = Product::find($item['product_id']);
                  $orderdetails = new OrderDetail;
                //    $order_details->order_code = $checkout_code;
                   $orderdetails->order_id = $order['order_id'];
                   $orderdetails->product_id = $item['product_id'];
                   $orderdetails->product_name = $product->name;
                   $orderdetails->product_price = $item['price'];
                   $orderdetails->product_quantity = $item['quantity'];
                   $orderdetails->product_feeship = $data['shippingFee'];
       
                //    $order_details->product_coupon =  $data['order_coupon'];
                //    $order_details->product_feeship = $data['order_fee'];
                // dd( $order_details);
                   $orderdetails->save();
                   $subtotal = $item['price'] * $item['quantity'];
                   $orderTotal += $subtotal;
                   $sales_count = $product->sales_count;
                   $sales_count +=$item['quantity'];
                   $product->sales_count= $sales_count;
                   $product->save();
                   
               }
                $feeship =  $orderdetails->product_feeship ;
               $order->order_total = $orderTotal+$feeship;
               $order->save();
         $data= $request->all();
         $code_cart= $orderID;
         $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";

         $vnp_Returnurl = "http://127.0.0.1:8000/checkout/vnPayCheck";


     $vnp_TmnCode = "T0FQURBD";//Mã website tại VNPAY 
     $vnp_HashSecret = "WDHTRSLUEMDRAOWAMDMWMVCZZSUIZDMR"; //Chuỗi bí mật
     
     $vnp_TxnRef = $code_cart; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
     $vnp_OrderInfo = 'thanh toan don hang test';
     $vnp_OrderType = 'billpayment';
     $vnp_Amount = $data['total_vnpay']*100;
     $vnp_Locale = 'vn';
     $vnp_BankCode = 'NCB';
     $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
     //Add Params of 2.0.1 Version
     //Billing
     $inputData = array(
         "vnp_Version" => "2.1.0",
         "vnp_TmnCode" => $vnp_TmnCode,
         "vnp_Amount" => $vnp_Amount,
         "vnp_Command" => "pay",
         "vnp_CreateDate" => date('YmdHis'),
         "vnp_CurrCode" => "VND",
         "vnp_IpAddr" => $vnp_IpAddr,
         "vnp_Locale" => $vnp_Locale,
         "vnp_OrderInfo" => $vnp_OrderInfo,
         "vnp_OrderType" => $vnp_OrderType,
         "vnp_ReturnUrl" => $vnp_Returnurl,
         "vnp_TxnRef" => $vnp_TxnRef
     
     
     );
    

     
     if (isset($vnp_BankCode) && $vnp_BankCode != "") {
         $inputData['vnp_BankCode'] = $vnp_BankCode;
     }
     if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
         $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        
     }
     
     //var_dump($inputData);
     ksort($inputData);
     $query = "";
     $i = 0;
     $hashdata = "";
     foreach ($inputData as $key => $value) {
         if ($i == 1) {
             $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
             
         } else {
             $hashdata .= urlencode($key) . "=" . urlencode($value);
             $i = 1;
             
         }
         $query .= urlencode($key) . "=" . urlencode($value) . '&';
     }
     
     $vnp_Url = $vnp_Url . "?" . $query;
     if (isset($vnp_HashSecret)) {
         $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
         $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
         
     }
     
     $returnData = array('code' => '00'
         , 'message' => 'success'
         , 'data' => $vnp_Url);
         
         if (isset($_POST['redirect'])) {
             header('Location: ' . $vnp_Url);
             die();
             
         } else {
            
             echo json_encode($returnData);
         }
        }    

        
        public function paypal_payment(CheckoutRequest $request){
            $data = $request->all();
            $user =User::where('id', Auth::id())->first();
            // dd($data);
            $cart = Cart::fromSession();
            // Back yo home page if dont have any item on Cart
            if($cart->items->count() == 0) 
            {
               return redirect('/home')->with('error','Have some issue with your checkout!! Please try again!');
            }

            $shippingold = Shipping::where('user_id', Auth::id())->first();
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
            $shipping->shipping_dictrictId = $data['district'];
            $shipping->shipping_wardId = $data['ward'];
            $shipping->shipping_name = $data['name'];
            // $shipping->shipping_name = $data['name'];
            $shipping->shipping_email = $data['email'];
            $shipping->shipping_phone = $data['phone'];
            $shipping->shipping_address = $address;
            $shipping->shipping_method = $data['shipping'];
            $shipping->shipping_notes = $data['deliver-note'];
            $shipping->shipping_address_street = $data['street'];
        
            $shipping->user_id = Auth::id();
            $shipping->save();
            $shipping_id = $shipping->id;
            }

            else{
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
                 $shipping->user_id = Auth::id();
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
                $shipping->shipping_method = $data['shipping'];
                $shipping->shipping_notes = $data['deliver-note'];
        
                // $shipping->shipping_notes = $data['shipping_notes'];
                // $shipping->shipping_method = $data['shipping_method'];
                $shipping->user_id = Auth::id();
                $shipping->save();
                $shipping_id = $shipping->id;
                
            }
            // $checkout_code = substr(md5(microtime()),rand(0,26),5);
            $voucherCode = $data['voucherCode'];
            // CHANGE VOUCHER TO USED (1)
            $order = new Order;
            $voucher = Voucher::where('code', $voucherCode )->first();
            if( $voucher)
            {
                if( $voucher->is_used === 0)
                {
                    $voucher->is_used = 1;
                    $voucher->save();
                    $order->usedvoucher = $voucherCode;
                }


            }
 
            $order->user_id = Auth::id();
            $order->shipping_id = $shipping_id;
            $order->order_status = 1;
            $order->payment_content = "Paid via Paypal";
            // $order->order_code = $checkout_code;
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $order->created_at = now();
            $order->order_date = now();
            $order->save();
            $orderTotal = 0;
            foreach($cart->items as  $item){
                  $product = Product::find($item['product_id']);
                 $orderdetails = new OrderDetail;
                //    $order_details->order_code = $checkout_code;
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

              
    
                //    $order_details->product_coupon =  $data['order_coupon'];
                //    $order_details->product_feeship = $data['order_fee'];
                // dd( $order_details);
                   $orderdetails->save();
                   $subtotal = $item['price'] * $item['quantity'];
                   $orderTotal += $subtotal;
                   $sales_count = $product->sales_count;
                   $sales_count +=$item['quantity'];
                   $product->sales_count= $sales_count;
                   $product->save();
                   
               }
                $feeship =  $orderdetails->product_feeship ;
               $order->order_total = $orderTotal+$feeship;
               $order->save();
               $cart->clear();

               $total = $order->order_total;
               if($total>1000)
               {
                $voucherCode = $this->generateVoucherCode();
                $expirationDate = now()->addDays(30);

                // Create voucher record
                $voucher = new Voucher();
                $voucher->code = $voucherCode;
                $voucher->type = 1;
                $voucher->name = "30$ Voucher";
                $voucher->discount = 30;
                $voucher->discounttype = 1;
                $voucher->user_id = Auth::id();
                $voucher->expiration_date = $expirationDate;
                $id=Auth::id();
                $voucher->save();
            
                // Send voucher code to user via email
                $user = User::find($id);
                $userEmail = $user->email;
                $this->sendVoucherEmail($userEmail, $voucherCode);


               }
               Mail::to($user->email)->send(new OrderDetailMail($user, $order));
               return redirect('/home')->with('message', 'Order Successfully! Thanks');
            }



            public function review(Request $request ,$product_id)
            {
                $user = $request->session()->get('user');
                $order = $request->session()->get('order');
                $providers = $request->session()->get('providers');
                $productreview=OrderDetail::where('product_id',$product_id)->first();
                return view('pages.review',compact('user','providers','productreview'));
            }
            public function savereview(Request $request)
            {
                $data = $request->all();
                $userId = Auth::id();
                $order = $request->session()->get('order');
                $order_id = $order->order_id;
                $orderdd = Order::where('order_id', $order_id)
                ->first();
                $order_date =  $orderdd->order_date;

                
                $productIds = $request->product_id;
                // return   $productIds;
                $ratings = $request->input('rating');

                $comments = $request->comment;
                // check comment good/bad comment
                //    dd($comments);
                $illegalWords = json_decode(file_get_contents(public_path() . "/json/illegal_words.json"), true)["illegalText"];

                $recieveComment = explode(" ", $comments);
                // return $recieveComment;
                for ($i = 0; $i < count($recieveComment); $i++) {
                    if (\in_array($recieveComment[$i], $illegalWords)) {
                        $recieveComment[$i] = "***";
                    }
                }
                $handledComment = "";
                $check = array_count_values($recieveComment);
        
                if (isset($check["***"])) {
                    if ($check["***"] > 3) {
                        $handledComment = "This comment illegal";
                    } else {
                        $handledComment = implode(
                            " ",
                            $recieveComment
                        );
                    }
                } else {
                    $handledComment = implode(
                        " ",
                        $recieveComment
                    );
                }

                // end check

                $order_detail = OrderDetail::where('order_id', $order_id)
               ->whereIn('product_id', $productIds)
               ->first();
                $orderdetail_id = $order_detail->orderdetail_id;
                $review = new Review();
                $review->product_id = $order_detail->product_id;
                $review->user_id = $userId;
                $review->orderdetail_id = $orderdetail_id;
                $review->rating = $ratings;
                $review->comment = $handledComment;

                $review->save();

                // $statisproducts = StatisProduct::where('date',$order_date)
                // ->where('product_id',$productIds )
                // ->first();
                // if($statisproducts)
                // {
                //         $statisproducts->review += 1;
                //         $statisproducts->save();
                // }
                // else
                // {
                //     $statisproducts = new StatisProduct();
                //     $statisproducts->date = $order->order_date;
                //     $statisproducts->product_id =$productIds;
                //     $statisproducts->review = 1;
                //     $statisproducts->save();
                // }
       

                return redirect('/vieworder/' . $order_id)->with('message', 'Review submitted successfully');
                        }




                        
   }

