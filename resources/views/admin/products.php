<?php
/**
 * LUXE SHOP — Admin: Product List
 */
// require_once __DIR__ . '/../../includes/config.php';
// if (!isAdmin()) redirect('/auth/login.php');

$adminTitle   = 'Products';
$adminSection = 'products';

// Backend: $products = $db->getAllProducts(...);
$products = [
  ['id'=>1,'name'=>'Cashmere Blend Coat','category'=>'Outerwear','price'=>389,'stock'=>8, 'status'=>'active','image'=>'/assets/images/products/p1.jpg'],
  ['id'=>2,'name'=>'Silk Evening Gown',  'category'=>'Dresses',  'price'=>290,'stock'=>15,'status'=>'active','image'=>'/assets/images/products/p2.jpg'],
  ['id'=>3,'name'=>'Leather Tote Bag',   'category'=>'Accessories','price'=>445,'stock'=>3,'status'=>'active','image'=>'/assets/images/products/p3.jpg'],
  ['id'=>4,'name'=>'Linen Trousers',     'category'=>'Bottoms',  'price'=>175,'stock'=>22,'status'=>'active','image'=>'/assets/images/products/p4.jpg'],
  ['id'=>5,'name'=>'Wool Blazer',        'category'=>'Outerwear','price'=>280,'stock'=>0, 'status'=>'draft', 'image'=>'/assets/images/products/p1.jpg'],
];

include __DIR__ . '/../includes/admin-header.php';
?>

<!-- Toolbar -->
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;flex-wrap:wrap;gap:1rem">
  <form method="GET" style="display:flex;gap:0.5rem">
    <input type="search" name="q" class="form-control" placeholder="Search products…" style="width:220px" value="<?= e($_GET['q']??'') ?>">
    <select name="category" class="form-control" style="width:160px">
      <option value="">All Categories</option>
      <option>Outerwear</option><option>Dresses</option><option>Accessories</option><option>Bottoms</option>
    </select>
    <select name="status" class="form-control" style="width:130px">
      <option value="">All Status</option>
      <option>active</option><option>draft</option>
    </select>
    <button type="submit" class="btn btn-ghost btn-sm">Filter</button>
  </form>
  <a href="/admin/pages/product-form.php" class="btn btn-primary btn-sm">+ Add Product</a>
</div>

<!-- Table -->
<div style="overflow-x:auto">
  <table class="data-table">
    <thead>
      <tr>
        <th><input type="checkbox" id="select-all"></th>
        <th data-sort="name">Product</th>
        <th data-sort="category">Category</th>
        <th data-sort="price">Price</th>
        <th data-sort="stock">Stock</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($products as $p): ?>
      <tr>
        <td><input type="checkbox" class="row-check" value="<?= $p['id'] ?>"></td>
        <td>
          <div style="display:flex;align-items:center;gap:0.75rem">
            <img src="<?= e($p['image']) ?>" alt="" style="width:40px;height:50px;object-fit:cover;border-radius:2px;background:var(--surface-2)">
            <div>
              <div style="font-weight:500;color:var(--text)"><?= e($p['name']) ?></div>
              <div style="font-size:0.72rem;color:var(--text-muted)">ID: <?= $p['id'] ?></div>
            </div>
          </div>
        </td>
        <td><?= e($p['category']) ?></td>
        <td><?= price($p['price']) ?></td>
        <td>
          <?php if ($p['stock'] === 0): ?>
            <span class="stock-badge stock-out">Out of Stock</span>
          <?php elseif ($p['stock'] <= 5): ?>
            <span class="stock-badge stock-low"><?= $p['stock'] ?> left</span>
          <?php else: ?>
            <span class="stock-badge stock-in"><?= $p['stock'] ?> in stock</span>
          <?php endif; ?>
        </td>
        <td>
          <span class="order-status <?= $p['status']==='active'?'status-delivered':'status-processing' ?>">
            <?= ucfirst(e($p['status'])) ?>
          </span>
        </td>
        <td>
          <div style="display:flex;gap:0.4rem">
            <a href="/admin/pages/product-form.php?id=<?= $p['id'] ?>" class="btn btn-ghost btn-sm">Edit</a>
            <a href="/pages/product.php?slug=<?= urlencode(strtolower(str_replace(' ','-',$p['name']))) ?>"
               class="btn btn-ghost btn-sm" target="_blank">View</a>
            <button class="btn btn-danger btn-sm"
                    data-confirm="Delete '<?= e($p['name']) ?>'? This cannot be undone."
                    onclick="document.location='/admin/pages/product-delete.php?id=<?= $p['id'] ?>'">Del</button>
          </div>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<!-- Pagination -->
<div style="display:flex;justify-content:space-between;align-items:center;margin-top:1.5rem">
  <p style="font-size:0.8rem;color:var(--text-muted)">Showing <?= count($products) ?> of <?= count($products) ?> products</p>
  <nav class="pagination">
    <a href="#" class="page-btn active">1</a>
    <a href="#" class="page-btn">2</a>
    <a href="#" class="page-btn">›</a>
  </nav>
</div>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
