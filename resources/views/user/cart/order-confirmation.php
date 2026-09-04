<?php
/**
 * LUXE SHOP — Order Confirmation Page
 */
// require_once __DIR__ . '/../includes/config.php';
// $order_id = $_GET['id'] ?? '';
// $order    = $db->fetchOrder($order_id);

$pageTitle  = 'Order Confirmed — Luxe Shop';
$order_id   = $_GET['id'] ?? '#LX-' . strtoupper(substr(md5(time()), 0, 8));

include __DIR__ . '/../includes/header.php';
?>

<section class="section" style="min-height:80vh;display:flex;align-items:center">
  <div class="container" style="text-align:center">
    <div style="font-size:4rem;margin-bottom:1.5rem">✓</div>
    <h1 style="color:var(--gold);margin-bottom:0.5rem">Order Confirmed!</h1>
    <p style="font-size:1rem;margin-bottom:0.25rem">Thank you for shopping with Luxe.</p>
    <p class="text-muted">Your order <strong><?= e($order_id) ?></strong> has been received and is being processed.</p>
    <div class="divider"></div>
    <p>A confirmation email has been sent to your registered email address.<br>You can track your order in <a href="/pages/account.php" style="color:var(--gold)">My Account</a>.</p>
    <div style="margin-top:2.5rem;display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
      <a href="/pages/shop.php" class="btn btn-primary">Continue Shopping</a>
      <a href="/pages/account.php#orders" class="btn btn-outline">View My Orders</a>
    </div>
  </div>
</section>

<script>
// Clear cart after confirmed order
if (typeof Cart !== 'undefined') Cart.clear();
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
