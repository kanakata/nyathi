<x-user.header></x-user.header>
<div class="page-hero">
    <div class="container">
        <h1>My Wishlist</h1>
        <nav class="breadcrumb">
            <a href="/">Home</a>
            <span class="breadcrumb-sep">›</span>
            <span>Wishlist</span>
        </nav>
    </div>
</div>

<section class="section">
    <div class="container">
        <div id="wishlist-container">
            <div class="spinner"></div>
            <div class="wishlist-grid"></div>
        </div>
    </div>
</section>

<template id="empty-wishlist">
    <div style="text-align:center;padding:4rem 0">
        <p style="font-size:3rem;margin-bottom:1rem">♡</p>
        <h3>Your wishlist is empty</h3>
        <p style="margin:1rem 0 2rem">Save items you love for later.</p><a href="/user/shop"
            class="btn btn-primary">Shop
            Now</a>
    </div>
</template>

<template id="wishlist-template">
    <div class="product-card">
        <div class="product-image-wrap">
            <img src="" alt="">
            <div class="product-actions-hover">
                <button class="btn-add-cart" data-action="add-to-cart" data-id="" data-name="" data-price=""
                    data-image="=">Add to Cart</button>
                <button class="btn-wishlist" data-action="toggle-wishlist" data-id="" data-name=""
                    data-price="">♥</button>
            </div>
        </div>
        <div class="product-info">
            <div class="product-name"></div>
            <div class="product-price"><span class="price-current"></span></div>
        </div>
    </div>
</template>

<x-user.footer></x-user.footer>
