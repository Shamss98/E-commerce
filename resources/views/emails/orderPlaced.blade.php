<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: Arial; background:#f5f5f5; padding:20px;">

    <div style="max-width:600px; margin:auto; background:#fff; padding:20px; border-radius:10px;">

        <h2 style="color:#333;">Hello {{ $user->name }} 👋</h2>

        <p>Your order has been placed successfully 🎉</p>

        <hr>

        <p><strong>Order ID:</strong> #{{ $order->id }}</p>
        <p><strong>Total:</strong> {{ number_format($order->total, 2) }} EGP</p>

        <a href="{{ url('/orders/' . $order->id) }}"
           style="display:inline-block; margin-top:15px; padding:10px 20px; background:#28a745; color:#fff; text-decoration:none; border-radius:5px;">
            View Order
        </a>

        <hr>

        <p style="font-size:12px; color:#777;">
            Thank you for shopping with us ❤️
        </p>

    </div>

</body>
</html>
