<x-user.header></x-user.header>
<div class="page-hero">
    <div class="container">
        <h1>Checkout</h1>
        <nav class="breadcrumb">
            <a href="/user/cart">Cart</a>
            <span class="breadcrumb-sep">›</span>
            <span>Checkout</span>
        </nav>
    </div>
</div>

<section class="section">
    <div class="container">
        <form method="POST" action="/product/order" id="checkout-form">
            @csrf
            <input id="product_id" type="hidden" name="product_id">
            <div class="checkout-layout">
                <div>
                    <div class="checkout-section">
                        <div class="checkout-section-title">Contact Information</div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" id="first_name" name="first_name" value="patrick"
                                    class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" id="last_name" name="last_name" value="kiprop" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" value="patrick@hmail.com" class="form-control"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" value="0791999321" class="form-control">
                        </div>
                    </div>

                    <div class="checkout-section">
                        <div class="checkout-section-title">Shipping Address</div>

                        <div class="form-group">
                            <label for="country">County</label>
                            <select id="county" name="country" class="form-control" required>
                                <option value="">Select county…</option>
                                @foreach ($counties as $county)
                                    <option value="{{ $county }}">{{ $county }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="checkout-section">
                        <div class="checkout-section-title">Payment Method</div>
                        <div class="payment-methods">
                            <label class="payment-option" id="pm-mpesa">
                                <input type="radio" name="payment_method" value="mpesa">
                                <div class="payment-option-info"><span>M-Pesa</span></div>
                            </label>
                        </div>

                    </div>

                </div>
                <div class="order-summary" style="position:sticky;top:90px">
                    <h3>Order Summary</h3>
                    <div id="checkout-items">
                    </div>
                    <div style="height:1px;background:var(--border);margin:1rem 0"></div>
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span id="summary-subtotal">—</span>
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
<x-user.footer></x-user.footer>
