<x-user.header></x-user.header>
<div class="page-hero">
    <div class="container">
        <h1>Your Cart</h1>
        <nav class="breadcrumb">
            <a href="/">Home</a>
            <span class="breadcrumb-sep">›</span>
            <span>Cart</span>
        </nav>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="cart-layout">
            <div>
                <div id="cart-items-container">
                    {{-- Rendered by main.js Cart.renderCartPage() --}}
                    <div class="spinner"></div>
                </div>
            </div>

            <div class="order-summary">
                <h3>Order Summary</h3>

                <div class="summary-row">
                    <span>Subtotal</span>
                    <span id="summary-subtotal">—</span>
                </div>
                <div class="summary-row">
                    <span>Shipping</span>
                    <span id="summary-shipping">—</span>
                </div>
                <div class="summary-row">
                    <span>Tax (estimated)</span>
                    <span>Calculated at checkout</span>
                </div>
                <div class="summary-row total">
                    <span>Total</span>
                    <span class="price" id="summary-total">—</span>
                </div>

                <div class="coupon-row">
                    <input type="text" class="form-control" placeholder="Coupon code" id="coupon-input">
                    <button class="btn btn-ghost btn-sm" id="apply-coupon">Apply</button>
                </div>

                <a href="/user/checkout" class="btn btn-primary btn-block" style="margin-bottom:0.75rem">
                    Proceed to Checkout
                </a>
                <a href="/user/shop" class="btn btn-ghost btn-block">Continue Shopping</a>

                <div style="margin-top:1.5rem;text-align:center">
                    <p style="font-size:0.72rem;margin-bottom:0.5rem">Secure payment powered by</p>
                    <div class="footer-payment-icons" style="justify-content:center">
                        <span>Mpesa</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<template id="empty-cart-template">
    <div style="text-align:center;padding:4rem 0">
        <p style="font-size:3rem;margin-bottom:1rem">🛍️</p>
        <h3>Your cart is empty</h3>
        <p style="margin:1rem 0 2rem">Looks like you haven't added anything yet.</p>
        <a href="/user/shop" class="btn btn-primary">Explore Products</a>
    </div>
</template>

<template id="cart-template">
    <div class="cart-item" data-key="">
        <img class="cart-item-img" src="" alt="">
        <div>
            <div class="cart-item-name"></div>
            <div class="cart-item-variant"></div>
            <div class="cart-item-controls">
                <div class="qty-control">
                    <button class="qty-btn dec" data-action="dec" data-key="">−</button>
                    <input class="qty-input" type="number" value="" min="1" data-key="">
                    <button class="qty-btn inc" data-action="inc" data-key="">+</button>
                </div>
                <button class="cart-item-remove" data-key="">Remove</button>
            </div>
        </div>
        <div class="cart-item-price"></div>
    </div>
</template>

<script>
    document.getElementById('apply-coupon')?.addEventListener('click', () => {
        const code = document.getElementById('coupon-input').value.trim();
        if (!code) return;
        // fetch('/api/coupon', { method:'POST', body: JSON.stringify({code}) })
        alert('Coupon functionality is handled by your backend.');
    });
</script>

<x-user.footer></x-user.footer>
