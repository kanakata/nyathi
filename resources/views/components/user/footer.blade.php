<?php
/**
 * LUXE SHOP — Site Footer
 * Include at the bottom of every frontend page.
 */
?>
</main><!-- /page-content -->

<!-- ========== SITE FOOTER ========== -->
<footer class="site-footer">
  <div class="container">
    <div class="footer-grid">

      <!-- Brand -->
      <div class="footer-brand">
        <a href="/" class="logo">Luxe<span>.</span></a>
        <p>Curated collections of premium fashion and lifestyle products. Elevate your everyday.</p>
        <div class="social-links">
          <a href="#" class="social-link" aria-label="Instagram">
            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
          </a>
          <a href="#" class="social-link" aria-label="Facebook">
            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
          </a>
          <a href="#" class="social-link" aria-label="Twitter / X">
            <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
          </a>
          <a href="#" class="social-link" aria-label="Pinterest">
            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12c0 4.24 2.65 7.86 6.39 9.29-.09-.78-.17-1.98.04-2.83.18-.76 1.24-5.27 1.24-5.27s-.32-.63-.32-1.57c0-1.47.85-2.57 1.92-2.57.9 0 1.34.68 1.34 1.49 0 .91-.58 2.27-.88 3.53-.25 1.05.52 1.91 1.56 1.91 1.87 0 3.12-2.4 3.12-5.24 0-2.16-1.46-3.77-4.1-3.77-2.99 0-4.85 2.23-4.85 4.72 0 .86.25 1.46.63 1.93.18.21.2.3.13.54l-.23.89c-.08.29-.25.36-.58.21-1.65-.76-2.42-2.82-2.42-5.12 0-3.79 3.2-8.33 9.56-8.33 5.1 0 8.46 3.7 8.46 7.67 0 5.25-2.92 9.18-7.19 9.18-1.43 0-2.78-.77-3.25-1.64l-.88 3.35c-.32 1.2-1.16 2.7-1.73 3.62.65.2 1.34.31 2.05.31 5.52 0 10-4.48 10-10S17.52 2 12 2z"/></svg>
          </a>
        </div>
      </div>

      <!-- Shop Links -->
      <div class="footer-col">
        <h5>Shop</h5>
        <ul>
          <li><a href="/shop">All Products</a></li>
          <li><a href="/shop/new">New Arrivals</a></li>
          <li><a href="/shop/sale">Sale</a></li>
          <li><a href="/categories">Categories</a></li>
          <li><a href="/shop/bestsellers">Best Sellers</a></li>
        </ul>
      </div>

      <!-- Info Links -->
      <div class="footer-col">
        <h5>Company</h5>
        <ul>
          <li><a href="/about">About Us</a></li>
          <li><a href="/contact">Contact</a></li>
          <li><a href="/careers">Careers</a></li>
          <li><a href="/press">Press</a></li>
          <li><a href="/sustainability">Sustainability</a></li>
        </ul>
      </div>

      <!-- Support Links -->
      <div class="footer-col">
        <h5>Support</h5>
        <ul>
          <li><a href="/faq">FAQ</a></li>
          <li><a href="/shipping">Shipping & Returns</a></li>
          <li><a href="/size-guide">Size Guide</a></li>
          <li><a href="/privacy">Privacy Policy</a></li>
          <li><a href="/terms">Terms of Service</a></li>
        </ul>
      </div>

    </div><!-- /footer-grid -->

    <!-- Footer Bottom Bar -->
    <div class="footer-bottom">
      <p class="text-muted">© <?= date('Y') ?> Luxe Shop. All rights reserved.</p>
      <div class="footer-payment-icons">
        <span>Visa</span>
        <span>Mastercard</span>
        <span>PayPal</span>
        <span>M-Pesa</span>
        <span>Stripe</span>
      </div>
    </div>

  </div>
</footer>

<!-- Main JS -->
<script src="/js/main.js"></script>
<?= $extraJs ?? '' ?>
</body>
</html>
