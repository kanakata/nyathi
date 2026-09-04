<?php
/**
 * LUXE SHOP — Categories Page
 */
// require_once __DIR__ . '/../includes/config.php';

$pageTitle  = 'All Categories — Luxe Shop';
$activePage = 'cats';

// Backend: $categories = $db->fetchAllCategories();
$categories = [
  ['name'=>'Women',         'slug'=>'women',       'count'=>240, 'image'=>'/assets/images/banners/cat-women.jpg',   'desc'=>'Dresses, Tops, Outerwear & more'],
  ['name'=>'Men',           'slug'=>'men',         'count'=>180, 'image'=>'/assets/images/banners/cat-men.jpg',     'desc'=>'Shirts, Trousers, Jackets & more'],
  ['name'=>'Accessories',   'slug'=>'accessories', 'count'=>90,  'image'=>'/assets/images/banners/cat-acc.jpg',     'desc'=>'Bags, Jewellery, Belts & more'],
  ['name'=>'Home & Living', 'slug'=>'home',        'count'=>60,  'image'=>'/assets/images/banners/cat-home.jpg',    'desc'=>'Candles, Throws, Décor & more'],
  ['name'=>'Footwear',      'slug'=>'footwear',    'count'=>75,  'image'=>'/assets/images/banners/cat-women.jpg',   'desc'=>'Heels, Flats, Boots & more'],
  ['name'=>'Beauty',        'slug'=>'beauty',      'count'=>45,  'image'=>'/assets/images/banners/cat-acc.jpg',     'desc'=>'Skincare, Fragrance & more'],
];


?>

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
      <?php foreach ($categories as $cat): ?>
      <a href="/shop/cat=<?= urlencode($cat['slug']) ?>" class="category-card" style="text-decoration:none">
        <div class="category-bg" style="background-image:url('<?= e($cat['image']) ?>')"></div>
        <div class="category-info">
          <h3><?= e($cat['name']) ?></h3>
          <p><?= e($cat['desc']) ?> · <?= $cat['count'] ?>+ items</p>
          <span class="category-link">Shop Now →</span>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<x-user.footer></x-user.footer>
