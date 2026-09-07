<x-utils.config></x-utils.config>

@php
    $activePage = $activePage ?? "";
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ e($pageDesc ?? 'Discover curated luxury fashion and lifestyle products.') }}">
    <title>{{ e($pageTitle ?? 'Nyathi Shop — Premium Fashion') }}</title>
    <link rel="icon" type="image/svg+xml" href="/assets/images/favicon.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Jost:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    {{ $extraCss ?? '' }}
</head>

<body class="{{ e($bodyClass ?? '') }}">

    <div class="announcement-bar">
        ✦ Free shipping on orders over $150 &nbsp;|&nbsp; New arrivals every week ✦
    </div>

    <header class="site-header">
        <a href="/" class="logo">Nyathi<span>.</span></a>

        <nav class="nav-menu" aria-label="Main navigation">
            <a href="/" class="{{ $activePage === 'home' ? 'active' : '' }}">Home</a>
            <a href="/shop" class="{{ $activePage === 'shop' ? 'active' : '' }}">Shop</a>
            <a href="/categories" class="{{ $activePage === 'cats' ? 'active' : '' }}">Categories</a>
            <a href="/about" class="{{ $activePage === 'about' ? 'active' : '' }}">About</a>
            <a href="/contact" class="{{ $activePage === 'contact' ? 'active' : '' }}">Contact</a>
        </nav>

        <div class="nav-actions">
            <button class="nav-icon" data-action="open-search" aria-label="Search">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8" />
                    <path d="m21 21-4.35-4.35" />
                </svg>
            </button>


            <a href="/wishlist" class="nav-icon" aria-label="Wishlist">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                    <path
                        d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                </svg>
                <span class="badge wishlist-count" style="display:none">0</span>
            </a>


            <a href="/login" class="nav-icon" aria-label="Account">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
            </a>


            <a href="/cart" class="nav-icon" aria-label="Cart">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                    <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z" />
                    <line x1="3" y1="6" x2="21" y2="6" />
                    <path d="M16 10a4 4 0 0 1-8 0" />
                </svg>
                <span class="badge cart-count" style="display:none">0</span>
            </a>


            <button class="hamburger" aria-label="Menu" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>
        </div>
    </header>

    <div class="search-overlay" role="dialog" aria-label="Search">
        <div class="search-inner">
            <h2>What are you looking for?</h2>
            <form method="GET" action="/shop">
                <div class="search-input-wrap">
                    <input type="search" name="q" placeholder="Search products…" autocomplete="off">
                    <button type="button" class="search-close" aria-label="Close search">✕</button>
                </div>
            </form>
        </div>
    </div>

    <main class="page-content">
