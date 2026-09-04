<?php
/**
 * LUXE SHOP — Product Card Partial
 *
 * Expects a $product array with keys:
 *   id, name, slug, price, old_price (optional), image, category,
 *   rating (0-5), review_count, badge ('new'|'sale'|'sold'|null), in_wishlist (bool)
 *
 * Usage:
 *   <?php foreach ($products as $product): ?>
 *     <?php include __DIR__ . '/product-card.php'; ?>
 *   <?php end foreach; ?>
 */

$badge      = $product['badge']       ?? null;
$old_price  = $product['old_price']   ?? null;
$rating     = (float)($product['rating'] ?? 0);
$reviews    = (int)($product['review_count'] ?? 0);
$in_wish    = (bool)($product['in_wishlist'] ?? false);
$stars      = str_repeat('★', round($rating)) . str_repeat('☆', 5 - round($rating));
?>
<div class="product-card">
  <div class="product-image-wrap">
    <a href="/pages/product.php?slug=<?= e($product['slug']) ?>">
      <img
        src="<?= e($product['image'] ?? '/assets/images/placeholder.jpg') ?>"
        alt="<?= e($product['name']) ?>"
        loading="lazy"
      >
    </a>

    <?php if ($badge): ?>
    <div class="product-badges">
      <span class="product-badge badge-<?= e($badge) ?>"><?= ucfirst(e($badge)) ?></span>
    </div>
    <?php endif; ?>

    <div class="product-actions-hover">
      <button
        class="btn-add-cart"
        data-action="add-to-cart"
        data-id="<?= e($product['id']) ?>"
        data-name="<?= e($product['name']) ?>"
        data-price="<?= e($product['price']) ?>"
        data-image="<?= e($product['image'] ?? '') ?>"
        <?= ($badge === 'sold') ? 'disabled' : '' ?>
      >
        <?= ($badge === 'sold') ? 'Sold Out' : 'Add to Cart' ?>
      </button>
      <button
        class="btn-wishlist <?= $in_wish ? 'active' : '' ?>"
        data-action="toggle-wishlist"
        data-id="<?= e($product['id']) ?>"
        data-name="<?= e($product['name']) ?>"
        data-price="<?= e($product['price']) ?>"
        data-image="<?= e($product['image'] ?? '') ?>"
        aria-label="Add to wishlist"
      ><?= $in_wish ? '♥' : '♡' ?></button>
    </div>
  </div>

  <div class="product-info">
    <?php if (!empty($product['category'])): ?>
    <div class="product-category"><?= e($product['category']) ?></div>
    <?php endif; ?>
    <a href="/pages/product.php?slug=<?= e($product['slug']) ?>">
      <h3 class="product-name"><?= e($product['name']) ?></h3>
    </a>
    <?php if ($rating > 0): ?>
    <div class="product-rating">
      <span class="stars" title="<?= $rating ?> out of 5"><?= $stars ?></span>
      <?php if ($reviews > 0): ?>
      <span class="rating-count">(<?= $reviews ?>)</span>
      <?php endif; ?>
    </div>
    <?php endif; ?>
    <div class="product-price">
      <span class="price-current"><?= price($product['price']) ?></span>
      <?php if ($old_price): ?>
      <span class="price-old"><?= price($old_price) ?></span>
      <?php endif; ?>
    </div>
  </div>
</div>
