@php
    $pageTitle = 'Order Confirmed — Luxe Shop';
    $order_id = $_GET['id'] ?? '#LX-' . strtoupper(substr(md5(time()), 0, 8));
@endphp

<x-user-header></x-user-header>

<section class="section" style="min-height:80vh;display:flex;align-items:center">
    <div class="container" style="text-align:center">
        <div style="font-size:4rem;margin-bottom:1.5rem">✓</div>
        <h1 style="color:var(--gold);margin-bottom:0.5rem">Order Confirmed!</h1>
        <p style="font-size:1rem;margin-bottom:0.25rem">Thank you for shopping with Luxe.</p>
        <p class="text-muted">Your order <strong><?= e($order_id) ?></strong> has been received and is being processed.
        </p>
        <div class="divider"></div>
        <p>A confirmation email has been sent to your registered email address.<br>You can track your order in <a
                href="/account" style="color:var(--gold)">My Account</a>.</p>
        <div style="margin-top:2.5rem;display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
            <a href="/shop" class="btn btn-primary">Continue Shopping</a>
            <a href="/account#orders" class="btn btn-outline">View My Orders</a>
        </div>
    </div>
</section>

<script>
    // Clear cart after confirmed order
    if (typeof Cart !== 'undefined') Cart.clear();
</script>

<x-user-footer></x-user-footer>
