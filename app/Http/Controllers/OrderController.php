<?php

namespace App\Http\Controllers;

use App\Mail\FinishOrderEmail;
use App\Mail\VoucherEmail;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shipping as ModelsShipping;
use App\Models\Shipping;
use App\Models\Staticstical;
use App\Models\StatisProduct;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\OrderDetail;
use App\Models\Provider;
use App\Models\User;
use App\Models\Voucher;
use App\Models\Review;
use Illuminate\Support\Facades\View;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Dompdf;


class OrderController extends Controller
{
    //
    public function index(){
      $id = Auth::id();
      $user = User::find($id);

    
         $orders = Order::where('user_id',Auth::id())
        ->orderBy('created_at', 'desc')
        ->get();
    
        return view('pages.orderhistory',compact('orders','user'));
     }


     public function cancel_order($order_id){
        $order= Order::where('order_id', $order_id)
        ->first();
//   5 Hủy đơn
        $order->order_status = 5;
        $order->save();
        return redirect('/order')->with('message','Order cancelled successfully');
     }

     public function cancel_orderPaypal($order_id){
        $order= Order::where('order_id', $order_id)
        ->first();
//   5 Hủy đơn
        $order->order_status = 9;
        $order->save();
        return redirect('/order')->with('message','Order cancelled successfully! Please wait for Refund process');
     }


     public function cancel_orderRefund(Request $request){
        $order_id = $request->getorderid;
        $order= Order::where('order_id', $order_id)
        ->first();
//   5 Hủy đơn
        $order->order_status = 10;
        $order->save();
        return redirect()->back()->with('message','Refund Sucessfully');
     }




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

public function sendVoucherEmail($email, $voucherCode)
{
 
    Mail::to($email)->send(new VoucherEmail($voucherCode));
}





     public function view_order($order_id){
        $orders= Order::where('order_id', $order_id)
        ->first();
        $shippingID = $orders->shipping_id;
        $shippings = Shipping::find($shippingID);
  
  
         $orderdetail = OrderDetail::where('order_id',$order_id)->first();
         $product_id = $orderdetail->product_id;

          $id = Auth::id();
          $user = User::find($id);
          $numberProduct = $orders->orderdetail->count();
          $vouchercode =   $orders->usedvoucher;
          $voucher =Voucher::where('code',$vouchercode)->first();
        return view('pages.vieworder',compact('orders','shippings','user','voucher','numberProduct'));
     }
   public function print_order($order_id)
   {
       // Retrieve the order data based on the provided order_id
       $orders = Order::find($order_id);
       $userID = $orders->user_id;
       $shippingsID = $orders->shipping_id;
       $user = User::find($userID);
       $shippings = Shipping::find($shippingsID);
       $vouchercode = $orders->usedvoucher;
       $voucher =Voucher::where('code',$vouchercode)->first();

       // Generate the PDF
       $pdf = Pdf::loadView('pages.printorder', compact('orders','user','shippings','voucher'));
         
       return $pdf->stream('order.pdf');
   }


   public function checkOrderStatus()
   {
         $id = Session::get('id');
  
       // Logic to retrieve the order status for the current user
       $orderStatus = Order::where('user_id',$id)->pluck('order_status')->toArray();

       // Check if the order status has changed
       $hasChanged = $this->hasOrderStatusChanged($orderStatus);

       // Return the response
       return response()->json(['status' => $hasChanged ? 'changed' : 'unchanged']);
   }

   public function admincheckOrderStatus()
{
    $orderStatus = Order::pluck('order_status')->toArray();
    $previousOrderStatus = session('previousOrderStatus', []);
    $hasChanged = count($orderStatus) > count($previousOrderStatus);
    session(['previousOrderStatus' => $orderStatus]);
    return response()->json(['status' => $hasChanged ? 'changed' : 'unchanged']);
}


   private function hasOrderStatusChanged(array $orderStatus)
   {
       // Retrieve the previous order status from the session or any other storage mechanism
       $previousOrderStatus = session('previous_order_status', []);

       // Compare the current and previous order status
       if ($orderStatus && $orderStatus != $previousOrderStatus) {
           // Update the previous order status in the session or any other storage mechanism
           session(['previous_order_status' => $orderStatus]);

           return true;
       }

       return false;
   }


   //order
public function manage_order(){
  $id = Session::get('admin_id');
  $admin = User::find($id);
  // $order = Order::orderby('created_at','DESC')->paginate(5);
  $order = Order::all();
  return view('admin.order.manage_order')->with(compact('order','admin'));
  // return view('admin.manage_order');
}

public function order_code(Request $request ,$order_code){
  $order = Order::where('order_code',$order_code)->first();
  $order->delete();
   Session::put('message','Xóa đơn hàng thành công');
  return redirect()->back();

}

public function admin_view_order($order_id){

  $orders= Order::where('order_id', $order_id)
  ->first();
  $vouchercode =   $orders->usedvoucher;
  $voucher =Voucher::where('code',$vouchercode)->first();
  $shippingID = $orders->shipping_id;
  $shippings = Shipping::find($shippingID);
  $id = $orders->user_id ;
  $user = User::find($id);
  $admin_id = Session('admin_id');
  $admin = User::find($admin_id);

  return view('admin.order.view_order')->with(compact('orders','shippings','admin','voucher','user'));

}



public function update_order_qty(Request $request){
  //update order
  $data = $request->all();
  $order = Order::find($data['order_id']);
  $order->order_status = $data['order_status'];
  $order->save();
  if($order->order_status == 4){
      foreach($data['order_product_id'] as $key => $product_id)
      {

          $product = Product::find($product_id);
          $product_quantity = $product->quantity;
          $product_price = $product->price;
          $product_buyprice = $product_price*0.9;
          $sales_count = $product->sales_count;
          foreach($data['quantity'] as $key2 => $qty){
                  if($key==$key2){
                          $sales =  $product_price*$qty;
                          $product->sales_count = $sales_count + $qty;
                          $product->save();

                         $order_date = $order->order_date;




                          $statisproducts = StatisProduct::where('date',$order_date )
                          ->where('product_id',$product_id )
                          ->first();

                          $staticstical = Staticstical::where('order_date',$order_date )->first();


                          if($statisproducts)


                          {
                                  $statisproducts->sales_count += $qty;
                                  $statisproducts->save();
                          }

                          else
                          {
                              $statisproducts = new StatisProduct();
                              $statisproducts->date = $order->order_date;
                              $statisproducts->product_id =$product_id;
                              $statisproducts->sales_count = $qty;
                              $statisproducts->save();
                          }

                          if($staticstical)
                          {
                              $staticstical->sales += $sales;
                              $staticstical->profit += $sales - ($qty*$product_buyprice);
                              $staticstical->quantity += $qty;
                              $staticstical->save();

                          }else
                          {
                              $statis = new Staticstical();
                              $statis->order_date = $order->order_date;
                              $statis->quantity = $qty;
                              $statis->sales = $sales;
                              $statis->profit = $sales - ($qty*$product_buyprice);
                              $statis->quantity = $qty;
                              $statis->save();
                          }
                  }
          }
      }
  }


  if($order->order_status == 2){
      foreach($data['order_product_id'] as $key => $product_id)
      {
          $product = Product::find($product_id);
          $product_quantity = $product->quantity;
          $product_price = $product->price;
          $product_buyprice = $product_price*0.9;
          foreach($data['quantity'] as $key2 => $qty){
                  if($key==$key2){
                          $pro_remain = $product_quantity - $qty;
                          $product->quantity = $pro_remain;
                          $product->save();
                  }
          }
      }
  }

  if($order->order_status == 8){
      foreach($data['order_product_id'] as $key => $product_id)
      {
          $product = Product::find($product_id);
          $product_quantity = $product->quantity;
          $product_price = $product->price;
          $product_buyprice = $product_price*0.9;
          foreach($data['quantity'] as $key2 => $qty){
                  if($key==$key2){
                          $pro_remain = $product_quantity + $qty;
                          $product->quantity = $pro_remain;
                          $product->save();
                  }
          }
      }
  }

  $orderDate =   $order->order_date;
  $totalOrders = Order::where('order_date', $orderDate)->where('order_status','4')->count();
  Staticstical::where('order_date', $orderDate)->update(['total_order' => $totalOrders]);
  $idss = $order->user_id;
  $user = User::find($idss);
  Mail::to($user->email)->send(new FinishOrderEmail($user, $order));
  //    send voucher code
  $voucherCode = "AAAA";
 

  if($order->order_total>1000 && $order->payment_content ==='COD')
  {
     $voucherCode = $this->generateVoucherCode();
     $expirationDate = now()->addDays(30);
     Mail::to($user->email)->send(new VoucherEmail($voucherCode));
     // Create voucher record
     $voucher = new Voucher();
     $voucher->code = $voucherCode;
     $voucher->type = 1;
     $voucher->name = "30$ Voucher";
     $voucher->discount = 30;
     $voucher->discounttype = 1;
     $voucher->user_id = Auth::id();
     $voucher->expiration_date = $expirationDate;
     $voucher->save();   
    }
 
}
}

