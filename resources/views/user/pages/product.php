<?php
/**
 * LUXE SHOP — Product Detail Page
 */
// require_once __DIR__ . '/../includes/config.php';

// $slug    = $_GET['slug'] ?? '';
// $product = $db->fetchProductBySlug($slug);
// if (!$product) { http_response_code(404); include '../pages/404.php'; exit; }

// Placeholder product
$product = [
  'id'          => 1,
  'name'        => 'Cashmere Blend Overcoat',
  'slug'        => 'cashmere-blend-overcoat',
  'brand'       => 'Luxe Collection',
  'price'       => 389.00,
  'old_price'   => 520.00,
  'description' => 'A masterwork in refined tailoring. This double-faced cashmere blend overcoat features a clean, structured silhouette with subtle peak lapels and a half-belt at the back. The fabric drapes beautifully and provides extraordinary warmth without weight.',
  'category'    => 'Outerwear',
  'sku'         => 'LC-OC-001',
  'rating'      => 4.8,
  'review_count'=> 124,
  'in_stock'    => true,
  'images'      => [
    '/assets/images/products/p1.jpg',
    '/assets/images/products/p2.jpg',
    '/assets/images/products/p3.jpg',
    '/assets/images/products/p4.jpg',
  ],
  'sizes'       => ['XS','S','M','L','XL'],
  'unavailable_sizes' => ['XS'],
  'colors'      => ['Camel','Black','Ivory'],
  'tags'        => ['coat','winter','cashmere','outerwear'],
];

$pageTitle = e($product['name']) . ' — Luxe Shop';
$activePage = 'shop';
$stars     = str_repeat('★', round($product['rating'])) . str_repeat('☆', 5 - round($product['rating']));

// Placeholder related products
$related = array_fill(0, 4, [
  'id'=>2,'name'=>'Wool Blazer','slug'=>'wool-blazer',
  'price'=>280,'old_price'=>null,'image'=>'/assets/images/products/p2.jpg',
  'category'=>'Outerwear','rating'=>4.5,'review_count'=>67,'badge'=>'new',
]);

include __DIR__ . '/../includes/header.php';
?>

<section class="section">
  <div class="container">
    <!-- Breadcrumb -->
    <nav class="breadcrumb mb-4" aria-label="Breadcrumb">
      <a href="/index.php">Home</a>
      <span class="breadcrumb-sep">›</span>
      <a href="/pages/shop.php">Shop</a>
      <span class="breadcrumb-sep">›</span>
      <a href="/pages/shop.php?cat=<?= urlencode($product['category']) ?>"><?= e($product['category']) ?></a>
      <span class="breadcrumb-sep">›</span>
      <span><?= e($product['name']) ?></span>
    </nav>

    <div class="product-detail">

      <!-- ===== GALLERY ===== -->
      <div class="product-gallery">
        <div class="gallery-main">
          <img src="<?= e($product['images'][0]) ?>" alt="<?= e($product['name']) ?>" id="main-image">
        </div>
        <div class="gallery-thumbs">
          <?php foreach ($product['images'] as $i => $img): ?>
          <div class="gallery-thumb <?= $i === 0 ? 'active' : '' ?>">
            <img src="<?= e($img) ?>" alt="View <?= $i + 1 ?>">
          </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- ===== PRODUCT INFO ===== -->
      <div class="product-info-detail">
        <div class="product-detail-brand"><?= e($product['brand']) ?></div>
        <h1 class="product-detail-title"><?= e($product['name']) ?></h1>

        <!-- Rating -->
        <div class="product-detail-rating">
          <span class="stars"><?= $stars ?></span>
          <a href="#reviews" class="rating-link"><?= $product['review_count'] ?> reviews</a>
        </div>

        <!-- Price -->
        <div class="product-detail-price">
          <span class="price-big"><?= price($product['price']) ?></span>
          <?php if ($product['old_price']): ?>
          <span class="price-old"><?= price($product['old_price']) ?></span>
          <span class="badge badge-sale" style="font-size:0.75rem;padding:0.3rem 0.75rem">
            <?= round((1 - $product['price'] / $product['old_price']) * 100) ?>% Off
          </span>
          <?php endif; ?>
        </div>

        <!-- Description -->
        <p class="product-detail-desc"><?= e($product['description']) ?></p>

        <!-- Size Selector -->
        <div class="variant-group">
          <div class="variant-label">Select Size <a href="/pages/size-guide.php" style="color:var(--gold);font-size:0.75rem;margin-left:1rem">Size Guide →</a></div>
          <div class="size-options">
            <?php foreach ($product['sizes'] as $size): ?>
            <button
              class="size-btn <?= in_array($size, $product['unavailable_sizes']) ? 'unavailable' : '' ?>"
              data-size="<?= e($size) ?>"
              <?= in_array($size, $product['unavailable_sizes']) ? 'disabled' : '' ?>
            ><?= e($size) ?></button>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Colour -->
        <div class="variant-group">
          <div class="variant-label">Colour</div>
          <div class="color-options">
            <?php
            $swatchColors = ['Camel'=>'#8b6f47','Black'=>'#1a1a1a','Ivory'=>'#f5f0e8'];
            foreach ($product['colors'] as $color): ?>
            <div class="color-swatch" style="background:<?= $swatchColors[$color] ?? '#ccc' ?>" title="<?= e($color) ?>"></div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Quantity + Add to Cart -->
        <div class="qty-add">
          <div class="qty-control">
            <button class="qty-btn" data-action="dec">−</button>
            <input class="qty-input" type="number" value="1" min="1" max="10">
            <button class="qty-btn" data-action="inc">+</button>
          </div>
          <button
            class="btn btn-primary"
            style="flex:1"
            data-action="add-to-cart"
            data-id="<?= e($product['id']) ?>"
            data-name="<?= e($product['name']) ?>"
            data-price="<?= e($product['price']) ?>"
            data-image="<?= e($product['images'][0]) ?>"
          >Add to Cart</button>
          <button
            class="btn btn-ghost"
            data-action="toggle-wishlist"
            data-id="<?= e($product['id']) ?>"
            data-name="<?= e($product['name']) ?>"
            data-price="<?= e($product['price']) ?>"
            data-image="<?= e($product['images'][0]) ?>"
            style="width:52px;height:52px;padding:0"
            aria-label="Add to wishlist"
          >♡</button>
        </div>

        <a href="/cart/checkout.php" class="btn btn-outline btn-block">Buy It Now</a>

        <!-- Delivery Info -->
        <div class="features-grid" style="grid-template-columns:1fr 1fr;margin-top:2rem;gap:1px">
          <div class="feature-item" style="padding:1.25rem">
            <div class="feature-icon" style="font-size:1rem">✦</div>
            <div class="feature-text">
              <h4>Free Shipping</h4>
              <p>On orders over $150</p>
            </div>
          </div>
          <div class="feature-item" style="padding:1.25rem">
            <div class="feature-icon" style="font-size:1rem">◈</div>
            <div class="feature-text">
              <h4>Free Returns</h4>
              <p>Within 30 days</p>
            </div>
          </div>
        </div>

        <!-- Product Meta -->
        <div class="product-meta">
          <div class="meta-row"><span class="label">SKU:</span> <span class="value"><?= e($product['sku']) ?></span></div>
          <div class="meta-row"><span class="label">Category:</span> <span class="value"><?= e($product['category']) ?></span></div>
          <div class="meta-row">
            <span class="label">Tags:</span>
            <span class="value"><?= implode(', ', array_map('e', $product['tags'])) ?></span>
          </div>
        </div>

      </div>
    </div><!-- /product-detail -->

    <!-- ===== RELATED PRODUCTS ===== -->
    <div style="margin-top:5rem">
      <div class="section-header" style="text-align:left">
        <h2>You May Also Like</h2>
        <div class="divider left"></div>
      </div>
      <div class="products-grid">
        <?php foreach ($related as $product): ?>
          <?php include __DIR__ . '/../includes/product-card.php'; ?>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- ===== REVIEWS SECTION ===== -->
    <div id="reviews" style="margin-top:5rem;padding-top:3rem;border-top:1px solid var(--border)">
      <div class="section-header" style="text-align:left">
        <h2>Customer Reviews</h2>
        <div class="divider left"></div>
      </div>
      <!-- Backend: render $reviews here -->
      <p class="text-muted">Reviews are loaded dynamically from your backend.</p>
    </div>

  </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
