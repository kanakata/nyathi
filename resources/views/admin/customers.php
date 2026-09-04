<?php
/**
 * LUXE SHOP — Admin: Customers
 */
$adminTitle   = 'Customers';
$adminSection = 'customers';

$customers = [
  ['id'=>1,'name'=>'Amara Osei',  'email'=>'amara@example.com','orders'=>5,'spent'=>1240,'joined'=>'Jan 2024','status'=>'active'],
  ['id'=>2,'name'=>'James Kariuki','email'=>'james@example.com','orders'=>2,'spent'=>430, 'joined'=>'Mar 2024','status'=>'active'],
  ['id'=>3,'name'=>'Sofia Mendez','email'=>'sofia@example.com','orders'=>8,'spent'=>2105,'joined'=>'Nov 2023','status'=>'active'],
  ['id'=>4,'name'=>'Kemi Adeyemi','email'=>'kemi@example.com', 'orders'=>1,'spent'=>175, 'joined'=>'Mar 2025','status'=>'active'],
  ['id'=>5,'name'=>'Paul Mutua',  'email'=>'paul@example.com', 'orders'=>0,'spent'=>0,   'joined'=>'Mar 2025','status'=>'inactive'],
];

include __DIR__ . '/../includes/admin-header.php';
?>

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;flex-wrap:wrap;gap:1rem">
  <form method="GET" style="display:flex;gap:0.5rem">
    <input type="search" name="q" class="form-control" placeholder="Name or email…" style="width:260px">
    <button type="submit" class="btn btn-ghost btn-sm">Search</button>
  </form>
  <a href="/admin/pages/customers.php?export=csv" class="btn btn-outline btn-sm">Export CSV</a>
</div>

<div style="overflow-x:auto">
  <table class="data-table">
    <thead>
      <tr>
        <th><input type="checkbox" id="select-all"></th>
        <th data-sort="name">Customer</th>
        <th data-sort="orders">Orders</th>
        <th data-sort="spent">Total Spent</th>
        <th data-sort="joined">Joined</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($customers as $c): ?>
      <tr>
        <td><input type="checkbox" class="row-check" value="<?= $c['id'] ?>"></td>
        <td>
          <div style="font-weight:500;color:var(--text)"><?= e($c['name']) ?></div>
          <div style="font-size:0.72rem;color:var(--text-muted)"><?= e($c['email']) ?></div>
        </td>
        <td><?= $c['orders'] ?></td>
        <td><?= price($c['spent']) ?></td>
        <td><?= e($c['joined']) ?></td>
        <td>
          <span class="order-status <?= $c['status']==='active'?'status-delivered':'status-cancelled' ?>">
            <?= ucfirst($c['status']) ?>
          </span>
        </td>
        <td>
          <a href="/admin/pages/customer-detail.php?id=<?= $c['id'] ?>" class="btn btn-ghost btn-sm">View</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
