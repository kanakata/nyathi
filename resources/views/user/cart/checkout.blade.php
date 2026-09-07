<x-user.header></x-user.header>
<div class="page-hero">
    <div class="container">
        <h1>Checkout</h1>
        <nav class="breadcrumb">
            <a href="/cart">Cart</a>
            <span class="breadcrumb-sep">›</span>
            <span>Checkout</span>
        </nav>
    </div>
</div>

<section class="section">
    <div class="container">
        <form method="POST" action="/process-order" id="checkout-form">
            <div class="checkout-layout">

                <!-- ===== LEFT: FORM ===== -->
                <div>

                    <!-- Contact Info -->
                    <div class="checkout-section">
                        <div class="checkout-section-title">Contact Information</div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" id="first_name" name="first_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" id="last_name" name="last_name" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" class="form-control">
                        </div>
                    </div>

                    <!-- Shipping Address -->
                    <div class="checkout-section">
                        <div class="checkout-section-title">Shipping Address</div>
                        <div class="form-group">
                            <label for="address">Street Address</label>
                            <input type="text" id="address" name="address" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="address2">Apartment, Suite, etc. (optional)</label>
                            <input type="text" id="address2" name="address2" class="form-control">
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" id="city" name="city" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="postal_code">Postal Code</label>
                                <input type="text" id="postal_code" name="postal_code" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <select id="county" name="country" class="form-control" required>
                                <option value="">Select county…</option>
                                @foreach ($counties as $initials => $county)
                                    <option value="{{ $initials }}">{{ $county }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Shipping Method -->
                    <div class="checkout-section">
                        <div class="checkout-section-title">Shipping Method</div>
                        <div class="payment-methods">
                            <label class="payment-option selected">
                                <input type="radio" name="shipping_method" value="standard" checked>
                                <div class="payment-option-info">
                                    <span>Standard Shipping (5–7 business days)</span><br>
                                    <small style="color:var(--text-muted)">Free on orders over $150, otherwise
                                        $9.99</small>
                                </div>
                            </label>
                            <label class="payment-option">
                                <input type="radio" name="shipping_method" value="express">
                                <div class="payment-option-info">
                                    <span>Express Shipping (2–3 business days)</span><br>
                                    <small style="color:var(--text-muted)">$19.99</small>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="checkout-section">
                        <div class="checkout-section-title">Payment Method</div>
                        <div class="payment-methods">
                            {{-- <label class="payment-option selected" id="pm-card">
                                <input type="radio" name="payment_method" value="card" checked>
                                <div class="payment-option-info"><span>Credit / Debit Card</span></div>
                                <div class="payment-icons">
                                    <span class="footer-payment-icons"><span>Visa</span><span>MC</span></span>
                                </div>
                            </label>
                            <label class="payment-option" id="pm-paypal">
                                <input type="radio" name="payment_method" value="paypal">
                                <div class="payment-option-info"><span>PayPal</span></div>
                            </label> --}}
                            <label class="payment-option" id="pm-mpesa">
                                <input type="radio" name="payment_method" value="mpesa">
                                <div class="payment-option-info"><span>M-Pesa</span></div>
                            </label>
                        </div>

                        <!-- Card Fields (shown when card is selected) -->
                        {{-- <div id="card-fields" style="margin-top:1.5rem">
                            <div class="form-group">
                                <label>Card Number</label>
                                <input type="text" name="card_number" class="form-control"
                                    placeholder="1234 5678 9012 3456" maxlength="19">
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Expiry Date</label>
                                    <input type="text" name="card_expiry" class="form-control" placeholder="MM / YY"
                                        maxlength="7">
                                </div>
                                <div class="form-group">
                                    <label>CVV</label>
                                    <input type="text" name="card_cvv" class="form-control" placeholder="•••"
                                        maxlength="4">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Name on Card</label>
                                <input type="text" name="card_name" class="form-control"
                                    placeholder="As it appears on the card">
                            </div>
                        </div> --}}

                    </div>

                </div>

                <!-- ===== RIGHT: ORDER SUMMARY ===== -->
                <div class="order-summary" style="position:sticky;top:90px">
                    <h3>Order Summary</h3>
                    <div id="checkout-items">
                        <!-- Populated by JS -->
                    </div>
                    <div style="height:1px;background:var(--border);margin:1rem 0"></div>
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span id="summary-subtotal">—</span>
                    </div>
                    <div class="summary-row">
                        <span>Shipping</span>
                        <span id="summary-shipping">—</span>
                    </div>
                    <div class="summary-row total">
                        <span>Total</span>
                        <span class="price" id="summary-total">—</span>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block" style="margin-top:1.5rem">
                        Place Order
                    </button>
                    <p style="text-align:center;font-size:0.72rem;margin-top:1rem">
                        🔒 Your payment information is encrypted and secure.
                    </p>
                </div>

            </div>
        </form>
    </div>
</section>

<script>
    // Payment method toggle
    document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
        radio.addEventListener('change', () => {
            document.querySelectorAll('.payment-option').forEach(o => o.classList.remove('selected'));
            radio.closest('.payment-option').classList.add('selected');
            document.getElementById('card-fields').style.display = radio.value === 'card' ? 'block' : 'none';
        });
    });
    // Shipping method toggle
    document.querySelectorAll('input[name="shipping_method"]').forEach(radio => {
        radio.addEventListener('change', () => {
            document.querySelectorAll('.payment-option').forEach(o => o.classList.remove('selected'));
            radio.closest('.payment-option').classList.add('selected');
        });
    });
</script>

<x-user.footer></x-user.footer>
