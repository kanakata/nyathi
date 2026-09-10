<x-user.header></x-user.header>

<!-- ========== HERO ========== -->
<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="hero-content">
            <div class="hero-eyebrow">New Collection · Season 2026/2027</div>
            <h1>NYATHI <em> Sports wear</em></h1>
            <h1>Buckle up with <em>Intention</em></h1>
            <p>Timeless pieces crafted for those who understand that true luxury lies in the details — not the label.
            </p>
            <div class="hero-actions">
                <a href="/shop" class="btn btn-primary">Explore Collection</a>
                <a href="/categories" class="btn btn-outline">Browse Categories</a>
            </div>
        </div>
    </div>
    <div class="scroll-indicator">
        <div class="scroll-line"></div>
        Scroll
    </div>
</section>

<!-- ========== FEATURES STRIP ========== -->
<section class="features-strip section-sm">
    <div class="container">
        <div class="features-grid">
            <div class="feature-item">
                <div class="feature-icon">✦</div>
                <div class="feature-text">
                    <h4>Free Shipping</h4>
                    <p>On all orders above Ksh: 5500</p>
                </div>
            </div>
            <div class="feature-item">
                <div class="feature-icon">◈</div>
                <div class="feature-text">
                    <h4>Easy Returns</h4>
                    <p>30-day hassle-free returns</p>
                </div>
            </div>
            <div class="feature-item">
                <div class="feature-icon">◉</div>
                <div class="feature-text">
                    <h4>Secure Payment</h4>
                    <p>100% encrypted checkout</p>
                </div>
            </div>
            <div class="feature-item">
                <div class="feature-icon">◆</div>
                <div class="feature-text">
                    <h4>Quality Promise</h4>
                    <p>Curated premium products only</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========== CATEGORIES ========== -->
<section class="section" style="padding-top:0">
    <div class="container">
        <div class="section-header">
            <h2>Shop by Category</h2>
            <div class="divider"></div>
            <p>Explore our carefully curated collections.</p>
        </div>
        <div class="categories-grid">
            @foreach ($categories as $cat)
                <div class="category-card">
                    <div class="category-bg"
                        style="background-image:url('/assets/category/{{ $cat->product_category . ".jpg" }}')"></div>
                    <div class="category-info">
                        <h3>{{ $cat->product_category }}</h3>
                        {{-- <p>In Stock {{ $cat->product_count }}</p> --}}
                        <a href="/user/shop/category/{{ $cat->product_category  }}" class="category-link">Shop Now →</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ========== FEATURED PRODUCTS ========== -->
<section class="section" style="background:var(--surface);padding:5rem 0">
    <div class="container">
        <div class="section-header">
            <h2>Featured Pieces</h2>
            <div class="divider"></div>
            <p>Hand-picked by our style team for effortless elegance.</p>
        </div>
        <div class="products-grid">
            @foreach ($featured as $product)
                <x-user.product-card :product="$product"></x-user.product-card>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="/user/shop" class="btn btn-outline">View All Products</a>
        </div>
    </div>
</section>

<!-- ========== PROMO BANNER ========== -->
<section class="promo-banner">
    <div class="promo-banner-bg"></div>
    <div class="container">
        <div class="promo-content">
            <div class="promo-eyebrow">Limited Time Offer</div>
            <h2>End-of-Season Sale — Up to 40% Off</h2>
            <p>Don't miss our biggest sale of the year. Premium pieces at unbeatable prices, for a limited time only.
            </p>
            <div class="promo-timer" data-end="{{ date('Y-m-d', strtotime('+5 days')) }}T23:59:00"></div>
            <a href="/shop/sale" class="btn btn-primary">Shop the Sale</a>
        </div>
    </div>
</section>

<!-- ========== TESTIMONIALS ========== -->
<section class="testimonials section">
    <div class="container">
        <div class="section-header">
            <h2>What Our Clients Say</h2>
            <div class="divider"></div>
        </div>
        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div class="testimonial-stars">★★★★★</div>
                <p class="testimonial-text">The SA fankit I ordered is absolutely stunning. The quality far exceeded
                    my expectations — worth every penny.</p>
                <div class="testimonial-author">
                    <div class="author-avatar" style="background:var(--surface-2)"></div>
                    <div>
                        <div class="author-name">Amara Osei</div>
                        <div class="author-title">Verified Buyer · Nairobi</div>
                    </div>
                </div>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-stars">★★★★★</div>
                <p class="testimonial-text">Fast shipping, beautiful packaging, and the boots fits like it was made for
                    me. I've already recommended Luxe to all my friends.</p>
                <div class="testimonial-author">
                    <div class="author-avatar" style="background:var(--surface-2)"></div>
                    <div>
                        <div class="author-name">Josh Hadi</div>
                        <div class="author-title">Verified Buyer · Mombasa</div>
                    </div>
                </div>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-stars">★★★★★</div>
                <p class="testimonial-text">The return process was seamless and the customer service team was incredibly
                    helpful. This is my new go-to store.</p>
                <div class="testimonial-author">
                    <div class="author-avatar" style="background:var(--surface-2)"></div>
                    <div>
                        <div class="author-name">James Kariuki</div>
                        <div class="author-title">Verified Buyer · Nakuru</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========== NEWSLETTER ========== -->
<section class="newsletter section-sm">
    <div class="container">
        <div class="newsletter-inner">
            <h2>Stay in the Loop</h2>
            <p>Get early access to new arrivals, exclusive offers, and style inspiration delivered to your inbox.</p>
            <form class="newsletter-form" method="POST" action="/newsletter">
                <input type="email" name="email" class="form-control" placeholder="Your email address" required>
                <button type="submit" class="btn btn-primary">Subscribe</button>
            </form>
        </div>
    </div>
</section>

<x-user.footer></x-user.footer>
