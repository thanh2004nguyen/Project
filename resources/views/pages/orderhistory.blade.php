
@extends('layouts.app')
@section('title','Order View')
@section('content')

<style>4
  .gradient-custom-2 {
 /* fallback for old browsers */
 background: #a1c4fd;

 /* Chrome 10-25, Safari 5.1-6 */
 background: -webkit-linear-gradient(to right, rgba(161, 196, 253, 1), rgba(194, 233, 251, 1));

 /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
 background: linear-gradient(to right, rgba(161, 196, 253, 1), rgba(194, 233, 251, 1))
 }

 #progressbar-1 {
 color: #455A64;
 }

 #progressbar-1 li {
 list-style-type: none;
 font-size: 13px;
 width: 25%;
 float: left;
 position: relative;
 }

 #progressbar-1 #step1:before {
 content: "1";
 color: #fff;
 width: 29px;
 margin-left: 22px;
 padding-left: 11px;
 }

 #progressbar-1 #step2:before {
 content: "2";
 color: #fff;
 width: 29px;
 }

 #progressbar-1 #step3:before {
 content: "3";
 color: #fff;
 width: 29px;
 margin-right: 22px;
 text-align: center;
 }

 #progressbar-1 #step4:before {
 content: "4";
 color: #fff;
 width: 29px;
 margin-right: 22px;
 text-align: center;
 }

 #progressbar-1 li:before {
 line-height: 29px;
 display: block;
 font-size: 12px;
 background: #455A64;
 border-radius: 50%;
 margin: auto;
 }

 #progressbar-1 li:after {
 content: '';
 width: 121%;
 height: 2px;
 background: #455A64;
 position: absolute;
 left: 0%;
 right: 0%;
 top: 15px;
 z-index: -1;
 }


 #progressbar-1 li:nth-child(1):after {
 left: 25%;
 width: 121%
 }

 #progressbar-1 li:nth-child(2):after {
 left: 50%
 }

 #progressbar-1 li:nth-child(3):after {
 left: 50%;
 width: 50%;
 }


 #progressbar-1 li:nth-child(4):after {
 left: 0%;
 width: 75%;
 }

 #progressbar-1 li.active:before,
 #progressbar-1 li.active:after {
 background: #1266f1;
 }

 .card-stepper {
 z-index: 0
 }
 .table-responsive{
    max-width: 100%;
    overflow-x: auto;
 }
 table{
    width: 100%;
    border-collapse: collapse;
 }
 @media(max-width: 1000px)
 {
    th{
        font-size: 14px;
        text-align: center;
    }
    td{
        font-size: 14px;
    }
    #progressbar-1>li>span{
        font-size: 10px;
    }
 }
 @media(max-width: 750px)
 {
    th{
        font-size: 13px;
        text-align: center;
    }
    td{
        font-size: 12px;
        text-align: center;
    }
    #progressbar-1>li>span{
        font-size: 9px;
    }
 }
 </style>

@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
 @endif

 @if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
 @endif


<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">

      </div>
      <div class="row w3-res-tb">
      </div>
      <div class="table-responsive">

        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th colspan="1">Number</th>
              <th colspan="1">Order Id</th>
              <th colspan="1">Order Date</th>
              <th colspan="4">Order Status</th>
              <th colspan="1">View/Cancel</th>
            </tr>
          </thead>
          <tbody>
            @php
            $i = 0;
            @endphp
            @foreach($orders as $order)
              @php
              $i++;
              @endphp
            @if($order->order_status != 6)
            <tr>
              <td colspan="1"><i>{{$i}}</i></label></td>
              <td colspan="1">{{ $order->order_id}}</td>
              <td colspan="1">{{ $order->created_at }}</td>
              <td colspan="4">@if($order->order_status==1)       
                <div class="card card-stepper" style="border-radius: 16px;" >
                  <div class="card-body p-1" >
                    <ul id="progressbar-1" class="mx-0 mt-0 mb-5 px-0 pt-0 pb-4">
                      <li class="step0 active" id="step1"><span
                          style="margin-left: 22px; margin-top: 12px;">Checking</span></li>
                      <li class="step0 muted text-center" id="step2"><span>Order Processed</span></li>
                      <li class="step0 text-muted text-end" id="step3"><span
                          style="margin-right: 22px;">SHIPPED</span></li>
                          <li class="step0 text-muted text-end" id="step4"><span
                          style="margin-right: 22px;">COMPLETED</span></li>
                    </ul>
                  </div>
                </div>
            @elseif($order->order_status==2)
                    <div class="card card-stepper" style="border-radius: 16px;" >
                      <div class="card-body p-1" >
                        <ul id="progressbar-1" class="mx-0 mt-0 mb-5 px-0 pt-0 pb-4">
                          <li class="step0 active" id="step1 b"><span
                              style="margin-left: 22px; margin-top: 12px;">Checking</span></li>

                          <li class="step0 active text-center" id="step2 b"><span>Order Processed</span></li>

                          <li class="step0 text-muted text-end" id="step3 b"><span
                              style="margin-right: 22px;">SHIPPED</span></li>
                              <li class="step0 text-muted text-end" id="step4 b"><span
                                style="margin-right: 22px;">COMPLETED</span></li>
                        </ul>
                      </div>
                    </div>
            @elseif($order->order_status==3)
            <div class="card card-stepper" style="border-radius: 16px;" >
              <div class="card-body p-1" >
                <ul id="progressbar-1" class="mx-0 mt-0 mb-5 px-0 pt-0 pb-4">
                  <li class="step0 active" id="step1"><span
                      style="margin-left: 22px; margin-top: 12px;">Checking</span></li>

                  <li class="step0 active text-center" id="step2"><span>Order Processed</span></li>

                  <li class="step0 active text-center" id="step3"><span
                      style="margin-right: 22px;">SHIPPED</span></li>
                      <li class="step0 text-muted text-end" id="step4"><span
                        style="margin-right: 22px;">COMPLETED</span></li>
                </ul>
              </div>
            </div>
            @elseif($order->order_status==4)
            <div class="card card-stepper" style="border-radius: 16px;" >
              <div class="card-body p-1" >
                <ul id="progressbar-1" class="mx-0 mt-0 mb-5 px-0 pt-0 pb-4">
                  <li class="step0 active" id="step1"><span
                      style="margin-left: 22px; margin-top: 12px;">Checking</span></li>

                  <li class="step0 active text-center" id="step2"><span>Order Processed</span></li>

                  <li class="step0 active text-center" id="step3"><span
                      style="margin-right: 22px;">SHIPPED</span></li>
                      <li class="step0 active text-center" id="step4"><span
                        style="margin-right: 22px;">COMPLETED</span></li>
                </ul>
              </div>
            </div>
            @elseif($order->order_status==5)
          <span style="font-size:15px" class="label label-danger">Order Canceled</span>
          @elseif($order->order_status==10)
          <span style="font-size:15px" class="label label-danger">Canceled/ Refunded.Please check Paypal</span>

          @elseif($order->order_status==9)
          <span style="font-size:15px" class="label label-danger">Canceled/Refunding </span>

            @elseif($order->order_status==6)
            Payment error
            @elseif($order->order_status==7)
            <div class="card card-stepper" style="border-radius: 16px;" >
              <div class="card-body p-1" >
                <ul id="progressbar-1" class="mx-0 mt-0 mb-5 px-0 pt-0 pb-4">
                  <li class="step0 active" id="step1"><span
                      style="margin-left: 22px; margin-top: 12px;">Checking</span></li>

                  <li class="step0 muted text-center" id="step2"><span>Order Processed</span></li>

                  <li class="step0 text-muted text-end" id="step3"><span
                      style="margin-right: 22px;">SHIPPED</span></li>


                      <li class="step0 text-muted text-end" id="step4"><span
                      style="margin-right: 22px;">COMPLETED</span></li>
                </ul>
              </div>
            </div>
            @elseif($order->order_status==8)
           <span style="font-size:15px" class="label label-danger">Customer Do Not Receive /Refuse Order</span>
            @endif
              </td>

              @if($order->order_status==7 )
              <td>
                <a href="{{URL::to('/vieworder/'.$order->order_id)}}" class="active styling-edit" ui-toggle-class="" >
                  <i class="fa fa-eye text-success text-active"></i></a>
                  <a onclick="return confirm('Are You Sure to Cancel Order?')" href="{{URL::to('/orders/'.$order->order_id)}}" class="active styling-edit" ui-toggle-class="">
                    <i class="fa fa-times text-danger text"></i>
                  </a>
              </td>
               @elseif($order->order_status==1 )
               <td>
                <a href="{{URL::to('/vieworder/'.$order->order_id)}}" class="active styling-edit" ui-toggle-class="" >
                  <i class="fa fa-eye text-success text-active"></i></a>
                  <a onclick="return confirm('Are You Sure to Cancel Order? You only get 70% of Paid Order')" href="{{URL::to('/ordersPaypal/'.$order->order_id)}}" class="active styling-edit" ui-toggle-class="">
                    <i class="fa fa-times text-danger text"></i>
                  </a>
              </td>

              
              @else
               <td>
                <a href="{{URL::to('/vieworder/'.$order->order_id)}}" class="active styling-edit" ui-toggle-class="" >
                  <i class="fa fa-eye text-success text-active"></i></a>
              </td>
              @endif
            </tr>
            @endif
            @endforeach
          </tbody>
        </table>
      </div>
      <footer class="panel-footer">
        <div class="row">

          <div class="col-sm-7 text-right text-center-xs">
            <ul class="pagination pagination-sm m-t-none m-b-none">
              {{-- {!!$order->links()!!} --}}
            </ul>
          </div>
        </div>
      </footer>

    </div>
  </div>
  @endsection
