<?php
/**
 * LUXE SHOP — Admin Dashboard
 */
// require_once __DIR__ . '/../../includes/config.php';
// if (!isAdmin()) redirect('/auth/login.php');

$adminTitle   = 'Dashboard';
$adminSection = 'dashboard';

// Backend: fetch real stats
// $stats = $db->getDashboardStats();

$stats = [
  ['label'=>'Total Revenue',   'value'=>'$48,320', 'change'=>'+12.4%', 'dir'=>'up'],
  ['label'=>'Orders Today',    'value'=>'34',       'change'=>'+5',     'dir'=>'up'],
  ['label'=>'New Customers',   'value'=>'128',      'change'=>'+8.1%',  'dir'=>'up'],
  ['label'=>'Avg. Order Value','value'=>'$142',     'change'=>'-2.3%',  'dir'=>'down'],
];

$recentOrders = [
  ['id'=>'LX-A4F1E2','customer'=>'Amara Osei',  'total'=>389.00,'status'=>'delivered','date'=>'Today, 09:14'],
  ['id'=>'LX-B8D3F7','customer'=>'James Kariuki','total'=>220.00,'status'=>'processing','date'=>'Today, 07:52'],
  ['id'=>'LX-C2E9A1','customer'=>'Sofia Mendez', 'total'=>655.00,'status'=>'shipped',  'date'=>'Yesterday'],
  ['id'=>'LX-D1F0A4','customer'=>'Kemi Adeyemi', 'total'=>175.00,'status'=>'processing','date'=>'Yesterday'],
  ['id'=>'LX-E7B3C9','customer'=>'Paul Mutua',   'total'=>290.00,'status'=>'delivered','date'=>'Mar 18'],
];

$topProducts = [
  ['name'=>'Cashmere Blend Coat', 'sold'=>42,'revenue'=>16338,'stock'=>8],
  ['name'=>'Silk Evening Gown',   'sold'=>31,'revenue'=>8990, 'stock'=>15],
  ['name'=>'Leather Tote Bag',    'sold'=>29,'revenue'=>12905,'stock'=>3],
  ['name'=>'Linen Trousers',      'sold'=>55,'revenue'=>9625, 'stock'=>22],
];

include __DIR__ . '/../includes/admin-header.php';
?>

<!-- Stat Cards -->
<div class="stat-cards">
  <?php foreach ($stats as $s): ?>
  <div class="stat-card">
    <div class="stat-label"><?= e($s['label']) ?></div>
    <div class="stat-value"><?= e($s['value']) ?></div>
    <div class="stat-change <?= $s['dir'] ?>"><?= $s['dir']==='up'?'↑':'↓' ?> <?= e($s['change']) ?> this month</div>
  </div>
  <?php endforeach; ?>
</div>

<!-- Chart Placeholder -->
<div style="display:grid;grid-template-columns:2fr 1fr;gap:1.5rem;margin-bottom:2rem">
  <div class="chart-box">
    <h4>Revenue Overview</h4>
    <div class="chart-placeholder">📈 Connect your analytics backend to render charts here</div>
  </div>
  <div class="chart-box">
    <h4>Sales by Category</h4>
    <div class="chart-placeholder">🥧 Pie chart</div>
  </div>
</div>

<!-- Recent Orders -->
<div class="chart-box" style="margin-bottom:2rem">
  <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem">
    <h4>Recent Orders</h4>
    <a href="/admin/pages/orders.php" class="btn btn-ghost btn-sm">View All</a>
  </div>
  <div style="overflow-x:auto">
    <table class="data-table">
      <thead>
        <tr>
          <th>Order ID</th>
          <th>Customer</th>
          <th>Total</th>
          <th>Status</th>
          <th>Date</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($recentOrders as $order): ?>
        <tr>
          <td><?= e($order['id']) ?></td>
          <td><?= e($order['customer']) ?></td>
          <td><?= price($order['total']) ?></td>
          <td><span class="order-status status-<?= $order['status'] ?>"><?= ucfirst($order['status']) ?></span></td>
          <td><?= e($order['date']) ?></td>
          <td><a href="/admin/pages/order-detail.php?id=<?= urlencode($order['id']) ?>" class="btn btn-ghost btn-sm">View</a></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Top Products -->
<div class="chart-box">
  <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem">
    <h4>Top Products This Month</h4>
    <a href="/admin/pages/products.php" class="btn btn-ghost btn-sm">All Products</a>
  </div>
  <table class="data-table">
    <thead>
      <tr><th>Product</th><th>Units Sold</th><th>Revenue</th><th>Stock</th></tr>
    </thead>
    <tbody>
      <?php foreach ($topProducts as $p): ?>
      <tr>
        <td><?= e($p['name']) ?></td>
        <td><?= $p['sold'] ?></td>
        <td><?= price($p['revenue']) ?></td>
        <td>
          <span class="stock-badge <?= $p['stock'] <= 5 ? 'stock-low' : 'stock-in' ?>">
            <?= $p['stock'] ?> left
          </span>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
