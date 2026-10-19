@props(['productCumulative', 'total'])
<div class="shop-toolbar">
    <span class="shop-count">Showing {{ $productCumulative }} of {{ $total }} products</span>
    <div class="toolbar-right">
        <label for="sort-select">
            <select class="sort-select" name="sort" id="sort-select">
                <option value="newest">Newest First</option>
                <option value="price_asc">Price: Low to High</option>
                <option value="price_desc">Price: High to Low</option>
                <option value="rating">Top Rated</option>
                <option value="popular">Most Popular</option>
            </select>
        </label>

        <div class="view-toggle">
            <button class="view-btn active" data-view="grid" title="Grid view">⊞</button>
            <button class="view-btn" data-view="list" title="List view">☰</button>
        </div>
    </div>
</div>
