<!DOCTYPE html>
<head>
<title>Admin Web</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>



<style>body{
    font-family: DejaVu Sans;
}
.table-styling{
    border:1px solid #000;
}
.table-styling tbody tr td{
    border:1px solid #000;
}

  
  table {
  border-collapse: collapse;
}

table, th, td {
  border: 1px solid black;
}
</style>


<body>
  <img  src="{{ asset('fontend/Image/logo.png') }}" alt="AdminLTE Logo" width="100px"  style="opacity: .8">
<h1><center>TREE ONE COMPANY</center></h1>
	

<div class="table-agile-info">
  <div class="panel panel-default">

    <div class="panel-heading">
      <h3> LOGIN INFO</h3>
    </div>
    
    <div class="table-responsive">

      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
          
            <th>CUSTOMER INFO</th>
            <th>PHONE</th>
            <th>Email</th>
          </tr>
        </thead>
        <tbody>
        
          <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->phone}}</td>
            <td>{{$user->email}}</td>
          </tr>
     
        </tbody>
      </table>

    </div>
   
  </div>
</div>
<br>


<div class="table-agile-info">
  
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3>SHIPPING INFO</h3>
     
    </div>
    <div class="table-responsive">
                
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>WHO RECEIVED?</th>
            <th>ADDRESS</th>
            <th>PHONE</th>
            <th>Email</th>
            <th>NOTE</th>
            <th>SHIPPING METHOD</th>
            <th>PAYMENT METHOD</th>
          </tr>
        </thead>
        <tbody>
        
          <tr>
           
             <td>{{$shippings->shipping_name}}</td>
            <td>{{$shippings->shipping_address}}</td>
             <td>{{$shippings->shipping_phone}}</td>
             <td>{{$shippings->shipping_email}}</td>
             <td>{{$shippings->shipping_notes}}</td>
             <td>{{$shippings->shipping_method}}</td>
             <td>{{$orders->payment_content}}</td>
    
          </tr>
     
        </tbody>
      </table>

    </div>
   
  </div>
</div>
<br><br>

<div class="table-agile-info">
  
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3>ORDER DETAIL</h3>
   
    </div>
   
    <div class="table-responsive">

      <table class="table table-striped b-t b-light" >
        <thead>
          <tr>
            <th>STT</th>
            <th>PRODUCT NAME</th>
            <th>STORE QUANTITY</th>
            <th>SHIPPING FEE</th>
            <th>QUANTITY</th>
            <th>PRICE</th>
            <th>COUPON</th>
            <th>TOTTAL</th>
          </tr>
        </thead>
        <tbody>
          @php 
          $i = 0;
          $total = 0;
          @endphp
        @foreach($orders ->orderdetail as $details)

          @php 
          $i++;
          $subtotal = $details->product_price*$details->product_quantity;
          $total+=$subtotal;
          @endphp




          <tr class="color_qty_{{$details->product_id}}">
            <td><i>{{$i}}</i></td>
            <td>{{$details->product_name}}</td>
            <td>{{$details->product->quantity}}</td>
            <td>
               @if($shippings->shipping_method == 'Free_Ship' )
               {{number_format(0 ,0,',','.')}}đ</td>
               @else
               {{number_format($details->product_feeship ,0,',','.')}}đ</td>
               @endif

            <td>
              {{$details->product_quantity}}
              <input hidden type="number" min="1" {{$orders->order_status==2 ? 'disabled' : ''}} class="order_qty_{{$details->product_id}}" value="{{$details->product_quantity}}" name="product_sales_quantity">

              <input type="hidden" name="order_qty_storage" class="order_qty_storage_{{$details->product_id}}" value="{{$details->product->quantity}}">

              <input type="hidden" name="order_id" class="order_id" value="{{$details->order_id}}">

              <input type="hidden" name="order_product_id" class="order_product_id" value="{{$details->product_id}}">
            </td>

            <td>{{number_format($details->product_price ,2,',','.')}}đ</td>
               
            
            <td>@if($orders->usedvoucher!=null)
              {{$orders->usedvoucher}}
            @else 
              Không mã
            @endif
          </td>

            <td>{{number_format($subtotal ,2,',','.')}}đ</td>

          </tr>

        @endforeach
      <tr>
            <td colspan="8">  
            @php 
                $total_coupon = 0;
              @endphp
              @if($voucher && $voucher->discounttype == 2)
                  @php
                  $discount = $voucher->discount;
                  $total_after_coupon = ($total* $discount)/100;
                  echo 'TOTAL DISCOUNT:'.number_format($total_after_coupon,0,',','.').'</br>';
                  $total_coupon = $total + $details->product_feeship - $total_after_coupon ;
                  @endphp
              @elseif($voucher && $voucher->discounttype == 1)
                  @php
                       $discount = $voucher->discount;
                  echo 'TOTAL DISCOUNT :'.number_format( $discount,2,',','.').'k'.'</br>';
                  $total_coupon = $total + $details->product_feeship -  $discount ;
                  @endphp
              @elseif(!$voucher)
              @php
              echo 'TOTAL DISCOUNT :'.number_format( 0,3,',','.').'k'.'</br>';
              $total_coupon = $total + $details->product_feeship ;
              @endphp
              @endif
              SHIPPING FEE: {{number_format($details->product_feeship,0,',','.')}} <br>
             PAY: ${{number_format($total_coupon,2,',','.')}}
            </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

</body>
</html>

