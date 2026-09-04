<?php
/**
 * LUXE SHOP — Cart Page
 */
// require_once __DIR__ . '/../includes/config';

$pageTitle  = 'Your Cart — Luxe Shop';
$activePage = 'shop';


?>
<x-user.header></x-user.header>
<div class="page-hero">
  <div class="container">
    <h1>Your Cart</h1>
    <nav class="breadcrumb">
      <a href="/index">Home</a>
      <span class="breadcrumb-sep">›</span>
      <span>Cart</span>
    </nav>
  </div>
</div>

<section class="section">
  <div class="container">
    <div class="cart-layout">

      <!-- ===== CART ITEMS ===== -->
      <div>
        <div id="cart-items-container">
          <!-- Rendered by main.js Cart.renderCartPage() -->
          <div class="spinner"></div>
        </div>
      </div>

      <!-- ===== ORDER SUMMARY ===== -->
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

        <!-- Coupon -->
        <div class="coupon-row">
          <input type="text" class="form-control" placeholder="Coupon code" id="coupon-input">
          <button class="btn btn-ghost btn-sm" id="apply-coupon">Apply</button>
        </div>

        <a href="/checkout" class="btn btn-primary btn-block" style="margin-bottom:0.75rem">
          Proceed to Checkout
        </a>
        <a href="/shop" class="btn btn-ghost btn-block">Continue Shopping</a>

        <div style="margin-top:1.5rem;text-align:center">
          <p style="font-size:0.72rem;margin-bottom:0.5rem">Secure payment powered by</p>
          <div class="footer-payment-icons" style="justify-content:center">
            <span>Visa</span>
            <span>Mastercard</span>
            <span>PayPal</span>
            <span>Stripe</span>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<script>
// Apply coupon — connect to backend
document.getElementById('apply-coupon')?.addEventListener('click', () => {
  const code = document.getElementById('coupon-input').value.trim();
  if (!code) return;
  // Example: fetch('/api/coupon', { method:'POST', body: JSON.stringify({code}) })
  alert('Coupon functionality is handled by your backend.');
});
</script>

<x-user.footer></x-user.footer>
