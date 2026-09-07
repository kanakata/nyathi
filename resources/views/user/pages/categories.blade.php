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
                <a href="/shop/category/{{ urlencode($cat['slug']) }}" class="category-card" style="text-decoration:none">
                    <div class="category-bg" style="background-image:url('{{ e($cat['image']) }}')"></div>
                    <div class="category-info">
                        <h3>{{ e($cat['name']) }}</h3>
                        <p>{{ e($cat['desc']) }} · {{ $cat['count'] }}+ items</p>
                        <span class="category-link">Shop Now →</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<x-user.footer></x-user.footer>
