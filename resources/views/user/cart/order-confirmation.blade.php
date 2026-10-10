@php
    $pageTitle = 'Order Confirmed — Nyathi Shop';
    $order_id = $_GET['id'] ?? '#LX-' . strtoupper(substr(md5(time()), 0, 8));
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/app.css">
</head>

<body>
    <section class="section" style="min-height:80vh;display:flex;align-items:center">
        <div class="container" style="text-align:center">
            <div style="font-size:4rem;margin-bottom:1.5rem">✓</div>
            <h1 style="color:var(--gold);margin-bottom:0.5rem">Order Confirmed!</h1>
            <p style="font-size:1.5rem;margin-bottom:0.55rem;color:green;">Check your phone to complete your payment.
            </p>
            <div class="divider"></div>
            <p style="font-size:1rem;margin-bottom:0.25rem">Thank you for shopping with Nyathi.</p>
            <p class="text-muted">Your order <strong><?= e($order_id) ?></strong> has been received and is being
                processed.
            </p>
            <div class="divider"></div>
            <p>A confirmation email has been sent to your registered email address.<br>You can track your order in <a
                    href="/account" style="color:var(--gold)">My Account</a>.</p>
            <div style="margin-top:2.5rem;display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
                <a href="/user/shop" class="btn btn-primary">Continue Shopping</a>
                <a href="/user/account/orders" class="btn btn-outline">View My Orders</a>
            </div>
        </div>
    </section>

    <script>
        // Clear cart after confirmed order
        if (typeof Cart !== 'undefined') Cart.clear();
    </script>

</body>

</html>
