<?php
/**
 * LUXE SHOP — Admin: Orders
 */
// require_once __DIR__ . '/../../includes/config.php';
// if (!isAdmin()) redirect('/auth/login.php');

$adminTitle   = 'Orders';
$adminSection = 'orders';

// Backend: $orders = $db->getAllOrders(...)
$orders = [
  ['id'=>'LX-A4F1E2','customer'=>'Amara Osei',  'email'=>'amara@example.com','total'=>389.00,'status'=>'delivered','date'=>'2025-03-15','items'=>1,'payment'=>'Card'],
  ['id'=>'LX-B8D3F7','customer'=>'James Kariuki','email'=>'james@example.com','total'=>220.00,'status'=>'processing','date'=>'2025-03-14','items'=>2,'payment'=>'M-Pesa'],
  ['id'=>'LX-C2E9A1','customer'=>'Sofia Mendez', 'email'=>'sofia@example.com','total'=>655.00,'status'=>'shipped',  'date'=>'2025-03-13','items'=>3,'payment'=>'PayPal'],
  ['id'=>'LX-D1F0A4','customer'=>'Kemi Adeyemi', 'email'=>'kemi@example.com', 'total'=>175.00,'status'=>'processing','date'=>'2025-03-12','items'=>1,'payment'=>'Card'],
  ['id'=>'LX-E7B3C9','customer'=>'Paul Mutua',   'email'=>'paul@example.com', 'total'=>290.00,'status'=>'cancelled','date'=>'2025-03-10','items'=>1,'payment'=>'Card'],
];

include __DIR__ . '/../includes/admin-header.php';
?>

<!-- Filters -->
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;flex-wrap:wrap;gap:1rem">
  <form method="GET" style="display:flex;gap:0.5rem;flex-wrap:wrap">
    <input type="search" name="q" class="form-control" placeholder="Order ID or customer…" style="width:220px">
    <select name="status" class="form-control" style="width:150px">
      <option value="">All Statuses</option>
      <option>processing</option><option>shipped</option><option>delivered</option><option>cancelled</option>
    </select>
    <input type="date" name="from" class="form-control" style="width:150px">
    <input type="date" name="to"   class="form-control" style="width:150px">
    <button type="submit" class="btn btn-ghost btn-sm">Filter</button>
  </form>
  <a href="/admin/pages/orders.php?export=csv" class="btn btn-outline btn-sm">Export CSV</a>
</div>

<!-- Orders Table -->
<div style="overflow-x:auto">
  <table class="data-table">
    <thead>
      <tr>
        <th><input type="checkbox" id="select-all"></th>
        <th data-sort="id">Order ID</th>
        <th data-sort="customer">Customer</th>
        <th data-sort="date">Date</th>
        <th>Items</th>
        <th data-sort="total">Total</th>
        <th>Payment</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($orders as $o): ?>
      <tr>
        <td><input type="checkbox" class="row-check" value="<?= e($o['id']) ?>"></td>
        <td style="font-weight:500;color:var(--text)"><?= e($o['id']) ?></td>
        <td>
          <div><?= e($o['customer']) ?></div>
          <div style="font-size:0.72rem;color:var(--text-muted)"><?= e($o['email']) ?></div>
        </td>
        <td><?= e($o['date']) ?></td>
        <td><?= $o['items'] ?></td>
        <td><?= price($o['total']) ?></td>
        <td><?= e($o['payment']) ?></td>
        <td><span class="order-status status-<?= $o['status'] ?>"><?= ucfirst($o['status']) ?></span></td>
        <td>
          <div style="display:flex;gap:0.4rem">
            <a href="/admin/pages/order-detail.php?id=<?= urlencode($o['id']) ?>" class="btn btn-ghost btn-sm">View</a>
          </div>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<div style="display:flex;justify-content:space-between;align-items:center;margin-top:1.5rem">
  <p style="font-size:0.8rem;color:var(--text-muted)">Showing <?= count($orders) ?> orders</p>
  <nav class="pagination">
    <a href="#" class="page-btn active">1</a>
    <a href="#" class="page-btn">2</a>
    <a href="#" class="page-btn">›</a>
  </nav>
</div>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
