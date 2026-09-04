<?php
/**
 * LUXE SHOP — Order Detail Page
 */
// require_once __DIR__ . '/../includes/config.php';
// if (!isLoggedIn()) redirect('/auth/login.php');
// $order = $db->fetchOrder($_GET['id']);

$pageTitle  = 'Order Detail — Luxe Shop';
$activePage = '';

// Placeholder
$order = [
  'id'       => $_GET['id'] ?? 'LX-A4F1E2',
  'date'     => 'March 15, 2025',
  'status'   => 'delivered',
  'customer' => 'Amara Osei',
  'email'    => 'amara@example.com',
  'address'  => 'Westlands, Nairobi, Kenya',
  'shipping' => 'Standard Shipping',
  'payment'  => 'Visa ending in 4242',
  'subtotal' => 389.00,
  'shipping_cost' => 0.00,
  'total'    => 389.00,
  'items'    => [
    ['name'=>'Cashmere Blend Coat','size'=>'M','color'=>'Camel','qty'=>1,'price'=>389.00,'image'=>'/assets/images/products/p1.jpg'],
  ],
];

include __DIR__ . '/../includes/header.php';
?>

<div class="page-hero">
  <div class="container">
    <h1>Order <?= e($order['id']) ?></h1>
    <nav class="breadcrumb">
      <a href="/pages/account.php">My Account</a>
      <span class="breadcrumb-sep">›</span>
      <a href="/pages/account.php#orders">Orders</a>
      <span class="breadcrumb-sep">›</span>
      <span><?= e($order['id']) ?></span>
    </nav>
  </div>
</div>

<section class="section">
  <div class="container">
    <div style="display:flex;align-items:center;gap:1rem;margin-bottom:2rem;flex-wrap:wrap">
      <span class="order-status status-<?= $order['status'] ?>" style="font-size:0.85rem;padding:0.5rem 1.25rem"><?= ucfirst($order['status']) ?></span>
      <span style="font-size:0.85rem;color:var(--text-muted)">Placed on <?= e($order['date']) ?></span>
    </div>

    <div style="display:grid;grid-template-columns:1fr 320px;gap:3rem;align-items:start">

      <!-- Items -->
      <div>
        <div style="margin-bottom:2rem">
          <h3 style="font-size:1rem;margin-bottom:1.25rem;letter-spacing:0.08em;text-transform:uppercase;color:var(--text-muted)">Items Ordered</h3>
          <div style="display:flex;flex-direction:column;gap:1px">
            <?php foreach ($order['items'] as $item): ?>
            <div class="cart-item">
              <img class="cart-item-img" src="<?= e($item['image']) ?>" alt="<?= e($item['name']) ?>">
              <div>
                <div class="cart-item-name"><?= e($item['name']) ?></div>
                <div class="cart-item-variant">
                  <?= implode(' · ', array_filter([$item['size'], $item['color']])) ?>
                  · Qty: <?= $item['qty'] ?>
                </div>
              </div>
              <div class="cart-item-price"><?= price($item['price'] * $item['qty']) ?></div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Delivery info -->
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem">
          <div class="card" style="padding:1.5rem">
            <h4 style="font-family:var(--font-body);font-size:0.72rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--text-muted);margin-bottom:1rem">Shipping Address</h4>
            <p style="font-size:0.85rem;line-height:1.7;color:var(--text)"><?= e($order['customer']) ?><br><?= e($order['address']) ?></p>
          </div>
          <div class="card" style="padding:1.5rem">
            <h4 style="font-family:var(--font-body);font-size:0.72rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--text-muted);margin-bottom:1rem">Payment Method</h4>
            <p style="font-size:0.85rem;color:var(--text)"><?= e($order['payment']) ?></p>
            <p style="font-size:0.75rem;margin-top:0.25rem"><?= e($order['shipping']) ?></p>
          </div>
        </div>
      </div>

      <!-- Summary -->
      <div class="order-summary" style="position:sticky;top:90px">
        <h3>Order Summary</h3>
        <div class="summary-row"><span>Subtotal</span><span><?= price($order['subtotal']) ?></span></div>
        <div class="summary-row"><span>Shipping</span><span><?= $order['shipping_cost'] > 0 ? price($order['shipping_cost']) : 'Free' ?></span></div>
        <div class="summary-row total">
          <span>Total</span>
          <span class="price"><?= price($order['total']) ?></span>
        </div>

        <?php if ($order['status'] === 'delivered'): ?>
        <div style="margin-top:1.5rem;display:flex;flex-direction:column;gap:0.75rem">
          <a href="/pages/return-request.php?order=<?= urlencode($order['id']) ?>" class="btn btn-outline btn-sm btn-block">Request Return</a>
          <a href="/pages/shop.php" class="btn btn-ghost btn-sm btn-block">Buy Again</a>
        </div>
        <?php elseif ($order['status'] === 'processing'): ?>
        <a href="/pages/cancel-order.php?id=<?= urlencode($order['id']) ?>"
           class="btn btn-ghost btn-sm btn-block" style="margin-top:1.5rem"
           data-confirm="Cancel this order?">Cancel Order</a>
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
