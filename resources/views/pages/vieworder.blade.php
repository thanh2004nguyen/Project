@extends('layouts.app')
@section('title','Order View')
@section('content')


    <div class="container" style="height: 90vh; ">
        <div class="row" style="height: 90%; " >
            <div class="col-sm-7" style="height: 90%;">
                                        <div class="table-agile-info" style="height: 35%;" >
                                            <div class="panel panel-default">
                                            <div class="panel-heading" style="margin: 30px 20px;">
                                            <h3 style="font-style: italic; text-decoration: none;">User Info</h3>
                                            </div>

                                            <div class="table-responsive"  style="overflow: hidden;">
                                                                <?php
                                                                    $message = Session::get('message');
                                                                    if($message){
                                                                        echo '<span class="text-alert">'.$message.'</span>';
                                                                        Session::put('message',null);
                                                                    }
                                                                    ?>



                                        <div class="col-lg-9 " style="width:100%;">
                                            <div class="input-group mb-2" style="height: 30px;">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text text-center" id="basic-addon1" style=" border:none;min-width: 160px;font-weight:bold;font-size: 16px;text-align:center ">Name</span>
                                                </div>
                                                <input name="name" style="height: 40px;border:none;font-size: 16px; padding-left: 50px;" type="text" value="{{$user->name}}" readonly class="form-control input-lg" id="inputlg" >
                                            </div>
    <hr style="width:70%;">
                                            <div class="input-group mb-2" style="height: 30px;">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text text-center" id="basic-addon1" style=" border:none;min-width: 160px;font-weight:bold;font-size: 16px;text-align:center ">Phone</span>
                                                </div>
                                                <input name="id" style="height: 40px;border:none;font-size: 16px; padding-left: 50px;" type="number" value="{{$user->phone}}" readonly class="form-control input-lg" id="inputlg" >
                                            </div>
    <hr style="width:70%;">
                                            <div class="input-group mb-2" style="height: 30px;">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text text-center" id="basic-addon1" style=" border:none;min-width: 160px;font-weight:bold;font-size: 16px;text-align:center ">Email</span>
                                                </div>
                                                <input name="id" style="height: 40px;border:none;font-size: 16px; padding-left: 50px;" type="email" value="{{$user->email}}" readonly class="form-control input-lg" id="inputlg" >
                                            </div>
                                        </div>

                                            </div>

                                            </div>
                                        </div>




              {{-- shipping info --}}
    <div class="table-agile-info" style="height: 55%;">
      <div class="panel panel-default">
        <div class="panel-heading" style="margin: 60px 10px 10px 20px;">
         <h3 style="font-style: italic; text-decoration: none; margin: 40px 10px ;">Shipping Info</h3>
        </div>


        <div class="table-responsive"  style="overflow: hidden;">
                          <?php
                                $message = Session::get('message');
                                if($message){
                                    echo '<span class="text-alert">'.$message.'</span>';
                                    Session::put('messag    e',null);
                                }
                                ?>

        <div class="col-lg-9 " style="width:100%;">
           <div style="display: flex; width:80%;">
            <div class="input-group mb-2" style="height: 30px;">
                <div class="input-group-prepend">
                    <span class="input-group-text text-center" id="basic-addon1" style=" border:none;min-width: 160px;font-weight:bold;font-size: 16px;text-align:center ">Shipping Name</span>
                </div>
                <input name="name" style="height: 40px;border:none;font-size: 16px; padding-left: 50px;" type="text" value="{{$shippings->shipping_name}}" readonly class="form-control input-lg" id="inputlg" >
            </div>

            <div class="input-group mb-2" style="height: 30px;">
                <div class="input-group-prepend">
                    <span class="input-group-text text-center" id="basic-addon1" style=" border:none;min-width: 160px;font-weight:bold;font-size: 16px;text-align:center ">Shipping Phone</span>
                </div>
                <input name="name" style="height: 40px;border:none;font-size: 16px; padding-left: 50px;" type="text" value="{{$shippings->shipping_phone}}" readonly class="form-control input-lg" id="inputlg" >
            </div>
           </div>
           <hr style="width:80%;">
           <div class="input-group mb-2" style="height: 30px;">
            <div class="input-group-prepend">
                <span class="input-group-text text-center" id="basic-addon1" style=" border:none;min-width: 160px;font-weight:bold;font-size: 16px;text-align:center ">Shipping Address</span>
            </div>
            <input name="name" style="height: 40px;border:none;font-size: 16px; padding-left: 50px;" type="text" value="{{$shippings->shipping_address}}" readonly class="form-control input-lg" id="inputlg" >
            </div>
            <hr style="width:70%;">
            <div class="input-group mb-2" style="height: 30px;">
                <div class="input-group-prepend">
                    <span class="input-group-text text-center" id="basic-addon1" style=" border:none;min-width: 160px;font-weight:bold;font-size: 16px;text-align:center ">Shipping Email</span>
                </div>
                <input name="name" style="height: 40px;border:none;font-size: 16px; padding-left: 50px;" type="text" value="{{$shippings->shipping_email}}" readonly class="form-control input-lg" id="inputlg" >
            </div>
            <hr style="width:70%;">
            <div class="input-group mb-2" style="height: 30px;">
                <div class="input-group-prepend">
                    <span class="input-group-text text-center" id="basic-addon1" style=" border:none;min-width: 160px;font-weight:bold;font-size: 16px;text-align:center ">Payment Detail</span>
                </div>
                <input name="name" style="height: 40px;border:none;font-size: 16px; padding-left: 50px;" type="text" value="{{$orders->payment_content}}" readonly class="form-control input-lg" id="inputlg" >
            </div>
            <hr style="width:70%;">
            <div class="input-group mb-2" style="height: 30px;">
                <div class="input-group-prepend">
                    <span class="input-group-text text-center" id="basic-addon1" style=" border:none;min-width: 160px;font-weight:bold;font-size: 16px;text-align:center ">Shipping Method</span>
                </div>
                <input name="name" style="height: 40px;border:none;font-size: 16px; padding-left: 50px;" type="text" value="{{$shippings->shipping_method}}" readonly class="form-control input-lg" id="inputlg" >
            </div>
        </div>
        </div>
      </div>
    </div>
          </div>

          {{-- total --}}
          <div class="col-sm-5" style=" width: 40%; height: 90vh;" >
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


            <div class="table-agile-info" >

                <div class="panel panel-default" >
                  <div class="panel-heading">
                   <h3  style="font-style: italic; text-decoration: none;text-align: center; padding: 30px 0px;">Order Detail</h3>
                  </div>


                  {{-- background Total --}}
                  <div style="background: #F8F9FA; padding: 10px;">
                    <div class="table-responsive" class="color_qty_{{$details->product_id}}" style="overflow: hidden;">
                        <?php
                              $message = Session::get('message');
                              if($message){
                                  echo '<span class="text-alert">'.$message.'</span>';
                                  Session::put('message',null);
                              }
                              ?>
        <div class="input-group mb-2" style="height: 30px;">
            <div class="input-group-prepend">
                <span class="input-group-text text-center" id="basic-addon1" style="background-color: transparent; border:none;min-width: 160px;font-weight:bold;font-size: 16px;text-align:center ">Number</span>
            </div>
            <input name="name" style="background-color: transparent;height: 40px;border:none;font-size: 16px; padding-left: 50px;" type="text" value="{{$i}}" readonly class="form-control input-lg" id="inputlg" >
        </div>
<p style="height: 1px;"></p>
        <div class="input-group mb-2" style="height: 30px;">
            <div class="input-group-prepend">
                <span class="input-group-text text-center" id="basic-addon1" style="background-color: transparent; border:none;min-width: 160px;font-weight:bold;font-size: 16px;text-align:center ">Product Name</span>
            </div>
            <input name="name" style="height: 40px;border:none;font-size: 16px;background-color: transparent; padding-left: 50px;" type="text" value="{{$details->product_name}}" readonly class="form-control input-lg" id="inputlg" >
        </div>
        <p style="height: 1px;"></p>
        <div class="input-group mb-2" style="height: 30px;">
            <div class="input-group-prepend">
                <span class="input-group-text text-center" id="basic-addon1" style="background-color: transparent; border:none;min-width: 160px;font-weight:bold;font-size: 16px;">Coupon Code</span>
            </div>
            <input name="name" style="height: 40px;border:none;font-size: 16px; background-color: transparent;" type="text" value="@if($orders->usedvoucher!=null)
            {{$orders->usedvoucher}}
        @else
        No Coupon Code
        @endif" readonly class="form-control input-lg" id="inputlg" >
        </div>
        <p style="height: 1px;"></p>
        <div class="input-group mb-2" style="height: 30px;">
            <div class="input-group-prepend">
                <span class="input-group-text text-center" id="basic-addon1" style="background-color: transparent; border:none;min-width: 160px;font-weight:bold;font-size: 16px;text-align:center ">Shipping Free</span>
            </div>
            <input name="name" style="height: 40px;border:none;font-size: 16px;background-color: transparent; padding-left: 50px;" type="text" value="${{number_format($details->product_feeship ,2,',','.')}}" readonly class="form-control input-lg" id="inputlg" >
        </div>
        <p style="height: 1px;"></p>
        <div class="input-group mb-2" style="height: 30px;">
            <div class="input-group-prepend">
                <span class="input-group-text text-center" id="basic-addon1" style="background-color: transparent; border:none;min-width: 160px;font-weight:bold;font-size: 16px;text-align:center ">Quantity</span>
            </div>
            <input name="name" style="height: 40px;border:none;font-size: 16px; padding-left: 50px;background-color: transparent;" type="text" value="{{$details->product_quantity}}" readonly class="form-control input-lg" id="inputlg" >
        </div>
        <p style="height: 1px;"></p>
        <div class="input-group mb-2" style="height: 30px;">
            <div class="input-group-prepend">
                <span class="input-group-text text-center" id="basic-addon1" style="background-color: transparent; border:none;min-width: 160px;font-weight:bold;font-size: 16px;text-align:center ">Price</span></span>
            </div>
            <input name="name" style="height: 40px;border:none;font-size: 16px;background-color: transparent; padding-left: 50px;" type="text" value="${{number_format($details->product_price ,2,',','.')}}" readonly class="form-control input-lg" id="inputlg" >
        </div>
        <p style="height: 1px;"></p>
        <div class="input-group mb-2" style="height: 30px;">
            <div class="input-group-prepend">
                <span class="input-group-text text-center" id="basic-addon1" style="background-color: transparent; border:none;min-width: 160px;font-weight:bold;font-size: 16px;text-align:center ">Total</span></span>
            </div>
            <input name="name" style="height: 40px;border:none;font-size: 16px;background-color: transparent; padding-left: 50px;" type="text" value="${{number_format($subtotal ,2,',','.')}}" readonly class="form-control input-lg" id="inputlg" >
        </div>
        <p style="height: 1px;"></p>
        <div class="input-group mb-2" style="height: 30px;">
            <div class="input-group-prepend">
                <span class="input-group-text text-center" id="basic-addon1" style="background-color: transparent; border:none;min-width: 160px;font-weight:bold;font-size: 16px;text-align:center ">Review</span></span>
            </div>

                @if($orders->order_status == 4)
                        @if($details->review)
                        <span style="background-color: transparent;">Already reviewed</span>
                        @else
                            <a href="{{ route('review', ['product_id' => $details->product_id]) }}" style="background-color: transparent;">Please Review</a>
                        @endif
                    @else
                    <span style="background-color: transparent;">You Can Review When Order Completed</span>
                    @endif
            </p>
        </div>
        <p style="height: 1px;"></p>
         <table class="table table-striped b-t b-light">
              <tbody style="font-size: 18px;">
                <tr >
                  <td colspan="2" style="margin-top: -10px;">
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
                    Pay: <span style="color: red; font-weight: 700;">${{number_format($total_coupon,2,',','.')}}</span>
                  </td>
                </tr>
                  </td>
                </tr>
              </tbody>
         </table>




      </div>
                  </div>


                </div>
              </div>
              @endforeach
          </div>
        </div>
      </div>
@endsection
