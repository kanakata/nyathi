<x-user.header></x-user.header>

<div class="page-hero">
    <div class="container">
        <h1>All Categories</h1>
        <nav class="breadcrumb">
            <a href="/">Home</a>
            <span class="breadcrumb-sep">›</span>
            <span>Categories</span>
        </nav>
    </div>
</div>

<section class="section">
    <div class="container">
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:1.5px">
            @foreach ($categories as $cat)
                <a href="/user/shop/category/{{ ($cat->product_category) }}" class="category-card"
                    style="text-decoration:none">
                    <div class="category-bg"
                        style="background-image:url('/assets/category/{{ e($cat->product_category) . ".jpg" }}')">
                    </div>
                    <div class="category-info">
                        <h3>{{ e($cat->product_category) }}</h3>
                        {{-- <p>{{ e($cat->product_description) }} ·
                            {{ number_format($cat->product_count - $cat->product_count / 2, 0) }} + items
                        </p> --}}
                        <span class="category-link">Shop Now →</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<x-user.footer></x-user.footer>
