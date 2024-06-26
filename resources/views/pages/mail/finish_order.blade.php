<!DOCTYPE html>
<html>
<head>
    <title>Order Completed</title>
</head>
<body>
    <h2>Your Order has Completed</h2>
    <p>Hi {{ $user->name }},</p>
    <p>Thank you for stand with us. Here are the details:</p>

    <h3>Order ID: {{ $order->order_id }}</h3>
    <p>Order Date: {{ $order->created_at }}</p>

    <h4>Products:</h4>
    <ul>
        @foreach ($order->orderdetail as $detail)
            <li>{{ $detail->product_name }} - ${{ $detail->product_price }}</li>
        @endforeach
    </ul>

    <p>Total: ${{ $order->order_total }}</p>

    <p>If you didnt get order yet, please immediatly  contact us.</p>

    <p>Best regards,<br>TREE ONE</p>
</body>
</html>