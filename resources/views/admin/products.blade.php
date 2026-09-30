<?php
/**
 * LUXE SHOP — Admin: Product List
 */
// if (!isAdmin()) redirect('/auth/login');

$adminTitle = 'Products';
$adminSection = 'products';



?>
<x-admin.header></x-admin.header>
<!-- Toolbar -->
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;flex-wrap:wrap;gap:1rem">
    <form method="GET" style="display:flex;gap:0.5rem">
        <input type="search" name="q" class="form-control" placeholder="Search products…" style="width:220px"
            value="<?= e($_GET['q'] ?? '') ?>">
        <select name="category" class="form-control" style="width:160px">
            <option value="">All Categories</option>
            <option>Outerwear</option>
            <option>Dresses</option>
            <option>Accessories</option>
            <option>Bottoms</option>
        </select>
        <select name="status" class="form-control" style="width:130px">
            <option value="">All Status</option>
            <option>active</option>
            <option>draft</option>
        </select>
        <button type="submit" class="btn btn-ghost btn-sm">Filter</button>
    </form>
    <a href="/admin/pages/product-form" class="btn btn-primary btn-sm">+ Add Product</a>
</div>

<!-- Table -->
<div style="overflow-x:auto">
    <table class="data-table">
        <thead>
            <tr>
                <th><input type="checkbox" id="select-all"></th>
                <th data-sort="name">Product</th>
                <th data-sort="category">Category</th>
                <th data-sort="price">Price</th>
                <th data-sort="stock">Stock</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td><input type="checkbox" class="row-check" value="{{ $product->id }}"></td>
                    <td>
                        <div style="display:flex;align-items:center;gap:0.75rem">
                            <img src="{{ $product->product_image }}" alt=""
                                style="width:40px;height:50px;object-fit:cover;border-radius:2px;background:var(--surface-2)">
                            <div>
                                <div style="font-weight:500;color:var(--text)">{{ $product->product_name }}</div>
                                <div style="font-size:0.72rem;color:var(--text-muted)">ID: {{ $product->id }}</div>
                            </div>
                        </div>
                    </td>
                    <td>{{ $product->product_category }}</td>
                    <td>{{ $product->product_price }}</td>
                    <td>
                        @if ($product->product_count == 0)
                            <span class="stock-badge stock-out">Out of Stock</span>
                        @elseif ($product->product_count <= 5)
                            <span class="stock-badge stock-low">{{ $product->product_count }} left</span>
                        @else
                            <span class="stock-badge stock-in">{{ $product->product_count }} in stock</span>
                        @endif
                    </td>
                    <td>
                        <span class="order-status <?= 'status' === 'active' ? 'status-delivered' : 'status-processing' ?>">
                            {{-- {{ ucfirst(e($p['status'])) }} --}}
                        </span>
                    </td>
                    <td>
                        <div style="display:flex;gap:0.4rem">
                            <a href="/admin/pages/product-form?id={{ $product->id }}" class="btn btn-ghost btn-sm">Edit</a>
                            <a href="/pages/product?slug={{ $product->product_name }}" class="btn btn-ghost btn-sm"
                                target="_blank">View</a>
                            <button class="btn btn-danger btn-sm"
                                data-confirm="Delete '{{ $product->product_name }}'? This cannot be undone."
                                onclick="document.location='/admin/pages/product-delete?id={{ $product->id }}'">Del</button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div style="display:flex;justify-content:space-between;align-items:center;margin-top:1.5rem">
    <p style="font-size:0.8rem;color:var(--text-muted)">Showing {{ count($products) }} of {{  count($products) }}
        products</p>
    <x-utils.pagination></x-utils.pagination>
</div>

<x-admin.footer></x-admin.footer>
