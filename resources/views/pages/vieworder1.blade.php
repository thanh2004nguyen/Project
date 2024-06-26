@extends('layouts.app')
@section('title','Order View')
@section('content')



<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
     <h3>User Info</h3>
    </div>
    
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
      <table class="table table-striped b-t b-light">
     
        <thead>
          <tr>
           
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            
            <th style="width:30px;"></th>
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
     <h3>Shipping Info</h3>
    </div>
    
    
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
           
            <th>Shipping Name</th>
            <th>Shipping Address</th>
            <th>Shipping Phone</th>
            <th>Email</th>
            <th>Payment Detail</th>
            <th>Shipping Method</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>  
          <tr>
            <td>{{$shippings->shipping_name}}</td>
            <td>{{$shippings->shipping_address}}</td>
             <td>{{$shippings->shipping_phone}}</td>
             <td>{{$shippings->shipping_email}}</td>
             <td>{{$orders->payment_content}}</td>
             <td>{{$shippings->shipping_method}}</td>
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
     <h3>Order Detail</h3>
    </div>
   
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
    
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:30px;">Number</th>
            <th>Product Name</th>
            <th>Coupon Code</th>
            <th>Shipping Fee</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
            <th>Review</th>
          </tr>
        </thead>
        <tbody>
          @php 
          $i = 0;
          $total = 0;
          @endphp
          @foreach($orders->orderdetail as $details)

          @php 
          $i++;
          $subtotal = $details->product_price*$details->product_quantity;
          $total+=$subtotal;
          @endphp
          <tr class="color_qty_{{$details->product_id}}">
           
            <td><i>{{$i}}</i></td>
            <td>{{$details->product_name}}</td>
        
            <td>@if($orders->usedvoucher!=null)
              {{$orders->usedvoucher}}
            @else 
              No Coupon Code
            @endif
            <td>${{number_format($details->product_feeship ,2,',','.')}}</td>
            <td>{{$details->product_quantity}}</td>
            <td>${{number_format($details->product_price ,2,',','.')}}</td>
            <td>${{number_format($subtotal ,2,',','.')}}</td>
            <td>

            @if($orders->order_status == 4)
                @if($details->review)
                <span>Already reviewed</span>
                @else
                    <a href="{{ route('review', ['product_id' => $details->product_id]) }}">Please Review</a>
                @endif
            @else  
            <span>You Can Review When Order Completed</span>  
            @endif
        </td>

          </tr>
        @endforeach
          <tr>
            <td colspan="2">  
              @php 
              $total_coupon = 0;
            @endphp
            @if($voucher && $voucher->discounttype == 2)
                @php
                $discount = $voucher->discount;
                $total_after_coupon = ($total* $discount)/100;
                echo 'Total Discount : $'.number_format($total_after_coupon,2,',','.').'</br>';
                $total_coupon = $total + $details->product_feeship - $total_after_coupon ;
                @endphp
            @elseif($voucher && $voucher->discounttype == 1)
                @php
                     $discount = $voucher->discount;
                echo 'Total Discount : $'.number_format( $discount,2,',','.').'$'.'</br>';
                $total_coupon = $total + $details->product_feeship -  $discount ;
                @endphp
            @elseif(!$voucher)
            @php
            echo 'Total Discount : $'.number_format( 0,2,',','.').''.'</br>';
            $total_coupon = $total + $details->product_feeship ;
            @endphp
            @endif

                   @php
                   $total_coupon = $total + $details->product_feeship ;
                   @endphp

              Shipping Fee : ${{number_format($details->product_feeship,2,',','.')}}</br> 
              Pay: <span style="color: red">${{number_format($total_coupon,2,',','.')}}</span> 
            </td>
          </tr>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
   
  </div>
</div>
@endsection