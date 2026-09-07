<x-user.header></x-user.header>

<!-- Page Hero -->
<div class="page-hero">
    <div class="container">
        <h1>All Products</h1>
        <nav class="breadcrumb" aria-label="Breadcrumb">
            <a href="/">Home</a>
            <span class="breadcrumb-sep">›</span>
            <span>Shop</span>
        </nav>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="shop-layout">

            <!-- ===== SIDEBAR FILTERS ===== -->
            <aside class="shop-sidebar">

                <div class="sidebar-section">
                    <div class="sidebar-title">Categories</div>
                    <div class="filter-options">
                        @foreach (['Women (240)', 'Men (180)', 'Accessories (90)', 'Home & Living (60)', 'Sale (45)'] as $cat)
                            <label class="filter-option">
                                <div class="filter-option-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">{{ $cat }}</span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="sidebar-section">
                    <div class="sidebar-title">Price Range</div>
                    <div class="price-range">
                        <input type="range" id="price-range" min="0" max="1000" value="500">
                        <div class="price-display">
                            <span>$0</span>
                            <span class="price-max">$500</span>
                        </div>
                    </div>
                </div>

                <div class="sidebar-section">
                    <div class="sidebar-title">Size</div>
                    <div class="filter-options">
                        @foreach (['XS (12)', 'S (45)', 'M (78)', 'L (63)', 'XL (29)', 'XXL (14)'] as $s)
                            <label class="filter-option">
                                <div class="filter-option-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">{{ $s }}</span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="sidebar-section">
                    <div class="sidebar-title">Colour</div>
                    <div class="color-options">
                        <div class="color-swatch" style="background:#1a1a1a;border:1px solid #555" title="Black"></div>
                        <div class="color-swatch" style="background:#f5f5f0" title="White"></div>
                        <div class="color-swatch" style="background:#8b6f47" title="Camel"></div>
                        <div class="color-swatch" style="background:#c9a96e" title="Gold"></div>
                        <div class="color-swatch" style="background:#2c3e50" title="Navy"></div>
                        <div class="color-swatch" style="background:#7f8c8d" title="Grey"></div>
                        <div class="color-swatch" style="background:#922b21" title="Burgundy"></div>
                        <div class="color-swatch" style="background:#1e8449" title="Forest Green"></div>
                    </div>
                </div>

                <div class="sidebar-section">
                    <div class="sidebar-title">Rating</div>
                    <div class="filter-options">
                        @foreach ([5, 4, 3] as $r)
                            <label class="filter-option">
                                <div class="filter-option-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">{{ str_repeat('★', $r) }}
                                        {{ str_repeat('☆', 5 - $r) }} & up
                                    </span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="sidebar-section">
                    <button class="btn btn-outline btn-sm btn-block">Clear All Filters</button>
                </div>

            </aside>

            <!-- ===== PRODUCT AREA ===== -->
            <div>
                <!-- Active Filters -->
                <div class="active-filters"></div>

                <!-- Toolbar -->
                <div class="shop-toolbar">
                    <span class="shop-count">Showing {{ $product_cumulative }} of {{ $total }} products</span>
                    <div class="toolbar-right">
                        <select class="sort-select" name="sort">
                            <option value="newest">Newest First</option>
                            <option value="price_asc">Price: Low to High</option>
                            <option value="price_desc">Price: High to Low</option>
                            <option value="rating">Top Rated</option>
                            <option value="popular">Most Popular</option>
                        </select>
                        <div class="view-toggle">
                            <button class="view-btn active" data-view="grid" title="Grid view">⊞</button>
                            <button class="view-btn" data-view="list" title="List view">☰</button>
                        </div>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="products-grid">
                    @foreach ($products as $product)
                        <x-user.product-card :product="$product"></x-user.product-card>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if ($totalPages > 1)
                    <nav class="pagination" aria-label="Page navigation">
                        @if ($currentPage > 1)
                            <a href="/shop/page/{{ $currentPage - 1 }}" class="page-btn">‹</a>
                        @endif

                        @for ($i = 1; $i <= $totalPages; $i++)
                            <a href="/shop/page/{{ $i }}" class="page-btn {{ $i === $currentPage ? 'active' : '' }}">{{ $i }}</a>
                        @endfor

                        @if ($currentPage < $totalPages)
                            <a href="/shop/page/{{ $currentPage + 1 }}" class="page-btn">›</a>
                        @endif

                    </nav>
                @endif


            </div>
        </div>
    </div>
</section>

<x-user.footer></x-user.footer>
