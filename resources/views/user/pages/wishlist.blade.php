<?php
/**
 * LUXE SHOP — Wishlist Page
 */
// require_once __DIR__ . '/../includes/config.php';

$pageTitle  = 'My Wishlist — Luxe Shop';
$activePage = '';

?>
<x-user.header></x-user.header>
<div class="page-hero">
  <div class="container">
    <h1>My Wishlist</h1>
    <nav class="breadcrumb">
      <a href="/index.php">Home</a>
      <span class="breadcrumb-sep">›</span>
      <span>Wishlist</span>
    </nav>
  </div>
</div>

<section class="section">
  <div class="container">
    <div id="wishlist-container">
      <!-- Rendered by main.js initWishlistPage() -->
      <div class="spinner"></div>
    </div>
  </div>
</section>

<x-user.footer></x-user.footer>
