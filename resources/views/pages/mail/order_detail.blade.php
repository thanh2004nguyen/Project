<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <style>
        .child {
            background-color: white;
            border: solid white;
            width: 70%;
            height: 540px;
            position: absolute;
            top: 30px;
            left: 15%;
        }

        .parent {
            background-color: #257865;
            width: 100%;
            height: 600px;
            position: relative;
        }

        .logo img {
            position: relative;
            left: 45%;
        }

        .t1 {
            color: green;
        }

        .t2 {
            color: orange;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="parent">
        <div class="child">
            <div class="logo"><img src="logo.png" alt="Logo"></div>

            <div>
                <h1 class="t1">Thank you, {{ $user->name }} , for buying our products </h1>
                <hr>

                <h2 class="t2">Here are your order details</h2>

                <!-- <h3>Order ID: {{ $order->order_id }}</h3>
                <p>Order Date: {{ $order->created_at }}</p>

                <h4>Products:</h4>
                <ul>
                    @foreach ($order->orderdetail as $detail)
                    <li>{{ $detail->product_name }} - ${{ $detail->product_price }}</li>
                    @endforeach
                </ul>

                <p>Total: {{ $order->order_total }}VND</p> -->

                <div>
                    <div class="order-detail">
                        <h4 class="title">
                            Order detail
                        </h4>
                    </div>

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
                                        @foreach ($order->orderdetail as $details)
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
                                        @if ($order->usedvoucher != null)
                                        {{ $order->usedvoucher }}
                                        @else
                                        No Coupon Code
                                        @endif
                                    </div>
                                    {{-- discount --}}
                                    {{-- <div>
                                        @php
                                        $total_coupon = 0;
                                        @endphp
                                        @if ($voucher && $voucher->discounttype == 2)
                                        @php
                                        $discount = $voucher->discount;
                                        $total_after_coupon = ($total * $discount) / 100;
                                        echo 'Total Discount : $' . number_format($total_after_coupon, 2, ',', '.') .
                                        '</br>';
                                        $total_coupon = $total + $details->product_feeship - $total_after_coupon;
                                        @endphp
                                        @elseif($voucher && $voucher->discounttype == 1)
                                        @php
                                        $discount = $voucher->discount;
                                        echo 'Total Discount : $' . number_format($discount, 2, ',', '.') . '' .
                                        '</br>';
                                        $total_coupon = $total + $details->product_feeship - $discount;
                                        @endphp
                                        @elseif(!$voucher)
                                        @php
                                        echo 'Total Discount : $' . number_format(0, 2, ',', '.') . '' . '</br>';
                                        $total_coupon = $total + $details->product_feeship;
                                        @endphp
                                        @endif
                                    </div> --}}
                                    {{-- shipping --}}
                                    <div>
                                        Shipping Fee : ${{ number_format($details->product_feeship, 2, ',', '.') }}
                                    </div>
                                    {{-- pay --}}
                                    <div>
                                        Total: ${{ $order->order_total }}
                                    </div>
                                </div>

                            </div>
                            
                            
                        </div>
                    </div>
                </div>

                <hr>
                <p>If you have any questions or need further assistance, please don't hesitate to contact us.</p>

                <p>Best regards,<br>TREE ONE </p>
            </div>
        </div>
    </div>
</body>

</html>