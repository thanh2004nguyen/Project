@extends('admin.app')
@section('content')
    <div class="container">
        <div class="container-fluid ">
            <div class="row py-4">
                <div class="col-md-6 ">
                    {{-- user detail  --}}
                    <div class="user-detail mb-4">
                        <div>
                            <h4 class="title">
                                User detail
                            </h4>
                        </div>
                        <?php
                        $message = Session::get('message');
                        if ($message) {
                            echo '<span class="text-alert">' . $message . '</span>';
                            Session::put('message', null);
                        }
                        ?>
                        <div class="wrap">
                            <div>
                                <span>Name: </span>
                                <span>{{ $user->name }}</span>
                            </div>
                            @if ($user->phone)
                                <div>
                                    <span>Phone: </span>
                                    <span>{{ $user->phone }}</span>
                                </div>
                            @endif
                            <div>
                                <span>Email: </span>
                                <span>{{ $user->email }}</span>
                            </div>
                        </div>


                    </div>
                    {{-- shopping detail  --}}

                    <div class="shopping-detail ">
                        <h4 class="title">Shopping detail</h4>

                        <?php
                        $message = Session::get('message');
                        if ($message) {
                            echo '<span class="text-alert">' . $message . '</span>';
                            Session::put('message', null);
                        }
                        ?>
                        <div class="wrap">
                            <div>
                                <span>Shipping Name: </span>
                                <span>{{ $shippings->shipping_name }}</span>
                            </div>
                            <div>
                                <span>Address: </span>
                                <span>{{ $shippings->shipping_address }}</span>
                            </div>
                            <div>
                                <span>Phone: </span>
                                <span>{{ $shippings->shipping_phone }}</span>
                            </div>
                            <div>
                                <span>Email: </span>
                                <span>{{ $shippings->shipping_email }}</span>
                            </div>
                            <div>
                                <span>Note: </span>
                                <span>{{ $shippings->shipping_notes }}</span>
                            </div>
                            <div>
                                <span>Shipping Method: </span>
                                <span>{{ $shippings->shipping_method }}</span>
                            </div>
                            <div>
                                <span>Payment Method: </span>
                                <span>{{ $orders->payment_content }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    {{-- order detail --}}
                    <div>
                        <div class="order-detail">
                            <h4 class="title">
                                Order detail
                            </h4>
                        </div>
                        <?php
                        $message = Session::get('message');
                        if ($message) {
                            echo '<span class="text-alert">' . $message . '</span>';
                            Session::put('message', null);
                        }
                        ?>
                        <div class="wrap">
                            <div>
                                {{-- table --}}
                                <div class="wrap-table">
                                    <table border="-1">
                                        <thead>
                                            <tr>
                                                <th style="width:20px;">
                                                    <label class="i-checks m-b-none">
                                                        No.
                                                    </label>
                                                </th>
                                                <th>Product Name</th>
                                                <th>Quantity in Stock</th>

                                                <th>Order Quantity</th>
                                                <th>Price</th>
                                                {{-- <th>Coupon/Voucher</th> --}}
                                                <th>Total</th>
                                                {{-- <th style="width:30px;"></th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 0;
                                                $total = 0;
                                            @endphp
                                            @foreach ($orders->orderdetail as $details)
                                                @php
                                                    $i++;
                                                    $subtotal = $details->product_price * $details->product_quantity;
                                                    $total += $subtotal;
                                                @endphp
                                                <tr class="color_qty_{{ $details->product_id }}">

                                                    <td><i>{{ $i }}</i></td>
                                                    <td>{{ $details->product_name }}</td>
                                                    <td>{{ $details->product->quantity }}</td>


                                                    <td>
                                                        {{ $details->product_quantity }}
                                                        <input hidden type="number" min="1"
                                                            {{ $orders->order_status == 2 ? 'disabled' : '' }}
                                                            class="order_qty_{{ $details->product_id }}"
                                                            value="{{ $details->product_quantity }}"
                                                            name="product_sales_quantity">

                                                        <input type="hidden" name="order_qty_storage"
                                                            class="order_qty_storage_{{ $details->product_id }}"
                                                            value="{{ $details->product->quantity }}">

                                                        <input type="hidden" name="order_id" class="order_id"
                                                            value="{{ $details->order_id }}">

                                                        <input type="hidden" name="order_product_id"
                                                            class="order_product_id" value="{{ $details->product_id }}">



                                                    </td>
                                                    <td>${{ number_format($details->product_price, 2, ',', '.') }}</td>

                                                    <td>${{ number_format($subtotal, 2, ',', '.') }}</td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row ">
                                    {{-- detail --}}
                                    <div class="col-md-6 mt-2  border-top border-black border-5">
                                        {{-- Coupon --}}
                                        <div>
                                            <span>Coupon/Voucher: </span>
                                            @if ($orders->usedvoucher != null)
                                                {{ $orders->usedvoucher }}
                                            @else
                                                No Coupon Code
                                            @endif
                                        </div>
                                        {{-- discount --}}
                                        <div>
                                            @php
                                                $total_coupon = 0;
                                            @endphp
                                            @if ($voucher && $voucher->discounttype == 2)
                                                @php
                                                    $discount = $voucher->discount;
                                                    $total_after_coupon = ($total * $discount) / 100;
                                                    echo 'Total Discount : $' . number_format($total_after_coupon, 2, ',', '.') . '</br>';
                                                    $total_coupon = $total + $details->product_feeship - $total_after_coupon;
                                                @endphp
                                            @elseif($voucher && $voucher->discounttype == 1)
                                                @php
                                                    $discount = $voucher->discount;
                                                    echo 'Total Discount : $' . number_format($discount, 2, ',', '.') . '' . '</br>';
                                                    $total_coupon = $total + $details->product_feeship - $discount;
                                                @endphp
                                            @elseif(!$voucher)
                                                @php
                                                    echo 'Total Discount : $' . number_format(0, 2, ',', '.') . '' . '</br>';
                                                    $total_coupon = $total + $details->product_feeship;
                                                @endphp
                                            @endif
                                        </div>
                                        {{-- shipping --}}
                                        <div>
                                            Shipping Fee : ${{ number_format($details->product_feeship, 2, ',', '.') }}
                                        </div>
                                        {{-- pay --}}
                                        <div>
                                            Pay: ${{ number_format($total_coupon, 2, ',', '.') }}
                                        </div>
                                        {{-- print --}}
                                        <a target="_blank" type="button" class="btn btn-primary"
                                            href="{{ url('/print-order/' . $details->order_id) }}">Print
                                            Order</a>
                                    </div>

                                    {{-- select delivery --}}
                                    <div class="col-md-6 d-flex align-items-center justify-content-center">
                                        @if ($orders->order_status == 1)
                                            <form>
                                                @csrf
                                                <select class="form-control order_details">
                                                    <option id="{{ $orders->order_id }}" selected value="1">Paid Order
                                                        processing </option>
                                                    <option id="{{ $orders->order_id }}" value="2">Order processed
                                                    </option>
                                                </select>
                                            </form>
                                        @elseif($orders->order_status == 2)
                                            <form>
                                                @csrf
                                                <select class="form-control order_details">

                                                    <option id="{{ $orders->order_id }}" selected value="2">Order
                                                        processed
                                                    </option>
                                                    <option id="{{ $orders->order_id }}" value="3"> Delivery</option>
                                                </select>
                                            </form>
                                        @elseif($orders->order_status == 3)
                                            <form>
                                                @csrf
                                                <select class="form-control order_details">
                                                    <option id="{{ $orders->order_id }}" selected value="3">Delivery
                                                    </option>
                                                    <option id="{{ $orders->order_id }}" value="4">
                                                        Delivered-Completed
                                                    </option>
                                                    <option id="{{ $orders->order_id }}" value="8"> Customer Do Not
                                                        Receive
                                                        /Refuse Order</option>
                                                </select>
                                            </form>
                                        @elseif($orders->order_status == 4)
                                            <form>
                                                @csrf
                                                <select class="form-control order_details">
                                                    <option id="{{ $orders->order_id }}" selected value="4">
                                                        Delivered-Completed</option>
                                                </select>
                                            </form>
                                        @elseif($orders->order_status == 5)
                                            <form>
                                                @csrf
                                                <select class="form-control order_details">
                                                    <option id="{{ $orders->order_id }}" selected value="5"> Order
                                                        Canceled
                                                    </option>

                                                </select>
                                            </form>
                                        @elseif($orders->order_status == 7)
                                            <form>
                                                @csrf
                                                <select class="form-control order_details">
                                                    <option id="{{ $orders->order_id }}" value="2">Order processed
                                                    </option>
                                                    <option id="{{ $orders->order_id }}" selected value="7">COD Order
                                                        processing</option>
                                                </select>
                                            </form>
                                        @elseif($orders->order_status == 9)
                                            <form>
                                                @csrf
                                                <select class="form-control order_details">
                                                    <option id="{{ $orders->order_id }}" value="10">Need Refund Process
                                                    </option>

                                                </select>
                                            </form>
                                        @elseif($orders->order_status == 10)
                                            <form>
                                                @csrf
                                                <select class="form-control order_details">
                                                    <option id="{{ $orders->order_id }}" value="10">Canceled/Refunded
                                                    </option>

                                                </select>
                                            </form>
                                        @else
                                            <form>
                                                @csrf
                                                <select class="form-control order_details">
                                                    <option id="{{ $orders->order_id }}" value="2">Order processed
                                                    </option>
                                                    <option id="{{ $orders->order_id }}" selected value="8">Customer
                                                        Do
                                                        Not
                                                        Receive /Refuse Order</option>
                                                </select>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                                <input type="hidden" id="getsubtotal" name="getsubtotal" value="{{ $total_coupon }}">
                                {{-- Refund --}}
                                <div class="mt-3 d-flex justify-content-center">
                                    @if ($orders->order_status == 9)
                                        <div class="refund">

                                            <h4>Make Refund For Customer</h4>
                                            <div class="col-md-13">
                                                @php
                                                    $vn_to_usd = $total_coupon;
                                                @endphp
                                                <div class="d-flex justify-content-center">

                                                    <div id="paypal-button"></div>
                                                </div>
                                                <input type="hidden" id="vn_to_usd" value="{{ round($vn_to_usd, 2) }}">
                                            </div>
                                            <form id="myForm" action="{{ URL::to('/ordersRefund') }}" method="get">
                                                @csrf
                                                <button style="display: none" class="get-quote-btn" type="submit"
                                                    value="confirmpaypal" name="action" id="confirm-button">
                                                </button>
                                                <input type="hidden" id="getorderid" name="getorderid"
                                                    value="{{ $orders->order_id }}">
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>












    </div>


    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script type="text/javascript">
        $('.order_details').change(function() {

            var order_status = $(this).val();
            var order_id = $(this).children(":selected").attr("id");
            var _token = $('input[name="_token"]').val();
            //lay ra so luong
            quantity = [];
            $("input[name='product_sales_quantity']").each(function() {
                quantity.push($(this).val());
            });

            storequantity = [];
            $("input[name='order_qty_storage']").each(function() {
                storequantity.push($(this).val());
            });

            //lay ra product id
            order_product_id = [];
            $("input[name='order_product_id']").each(function() {
                order_product_id.push($(this).val());
            });

            j = 0;
            for (i = 0; i < order_product_id.length; i++) {
                //so luong khach dat
                var order_qty = $('.order_qty_' + order_product_id[i]).val();
                //so luong ton kho
                var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();

                if (parseInt(order_qty) > parseInt(order_qty_storage) && order_status in [1, 7, 8]) {
                    j = j + 1;
                    if (j == 1) {
                        alert('We dont have enough in Store');
                    }
                    $('.color_qty_' + order_product_id[i]).css('background', '#1d8296');
                }
            }
            if (j == 0) {

                $.ajax({
                    url: '{{ url('/update-order-qty') }}',
                    method: 'POST',
                    data: {
                        _token: _token,
                        order_status: order_status,
                        order_id: order_id,
                        quantity: quantity,
                        order_product_id: order_product_id
                    },
                    success: function(data) {
                        alert('Changed Order Status Sucessfully');
                        location.reload();
                    }
                });

            }



        });
    </script>
@endsection
