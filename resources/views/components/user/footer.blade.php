</main>
<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <a href="/" class="logo">Nyathi<span>.</span></a>
                <p>Curated collections of premium sports products. Elevate your game.</p>
                <div class="social-links">
                    <a href="#" class="social-link" aria-label="Instagram">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                        </svg>
                    </a>
                    <a href="#" class="social-link" aria-label="Facebook">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="footer-col">
                <h5>Shop</h5>
                <ul>
                    <li><a href="/user/shop">All Products</a></li>
                    <li><a href="/user/categories">Categories</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h5>Company</h5>
                <ul>
                    <li><a href="/user/about">About Us</a></li>
                    <li><a href="/user/contact">Contact</a></li>
                    <li><a href="/user/careers">Careers</a></li>
                    <li><a href="/user/press">Press</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h5>Support</h5>
                <ul>
                    <li><a href="/user/faq">FAQ</a></li>
                    <li><a href="/user/shipping">Shipping & Returns</a></li>
                    <li><a href="/user/size-guide">Size Guide</a></li>
                    <li><a href="/user/privacy">Privacy Policy</a></li>
                    <li><a href="/user/terms">Terms of Service</a></li>
                </ul>
            </div>

        </div>

        <div class="footer-bottom">
            <p class="text-muted">© {{ date('Y') }} Nyathi Shop. All rights reserved.</p>
            <div class="footer-payment-icons">
                <span>Payment Methods</span>
                <span>M-Pesa</span>
            </div>
        </div>

    </div>
</footer>
<script src="/js/utils.js"></script>
<script src="/js/app.js"></script>
@if (request()->path() == "user/shop")
    <script src="/js/products.js"></script>
@endif
</body>

</html>
