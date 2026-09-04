<?php
/**
 * LUXE SHOP — Admin Header
 * Include at top of every admin page.
 *
 * Variables to set before including:
 *   $adminTitle   - page heading
 *   $adminSection - active nav section key
 */
// require_once __DIR__ . '/../../includes/config.php';
// if (!isAdmin()) redirect('/auth/login.php');

$adminTitle   = $adminTitle   ?? 'Dashboard';
$adminSection = $adminSection ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e($adminTitle) ?> — Luxe Admin</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;600&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="/admin/assets/admin.css">
</head>
<body class="admin-body">

<div class="admin-layout">

<!-- ===== SIDEBAR ===== -->
<aside class="admin-sidebar">
  <div class="admin-logo">
    <a href="/admin/pages/dashboard.php" class="logo" style="font-size:1.1rem">Luxe<span>.</span> <small style="font-size:0.55rem;letter-spacing:0.15em;color:var(--text-muted);vertical-align:super">ADMIN</small></a>
  </div>

  <nav>
    <div class="admin-nav-section">
      <div class="admin-nav-label">Overview</div>
      <a href="/admin/pages/dashboard.php"  class="admin-nav-link <?= $adminSection==='dashboard'?'active':'' ?>">📊 Dashboard</a>
      <a href="/admin/pages/analytics.php"  class="admin-nav-link <?= $adminSection==='analytics'?'active':'' ?>">📈 Analytics</a>
    </div>

    <div class="admin-nav-section">
      <div class="admin-nav-label">Catalogue</div>
      <a href="/admin/pages/products.php"   class="admin-nav-link <?= $adminSection==='products'?'active':'' ?>">🛍️ Products</a>
      <a href="/admin/pages/categories.php" class="admin-nav-link <?= $adminSection==='categories'?'active':'' ?>">🗂️ Categories</a>
      <a href="/admin/pages/inventory.php"  class="admin-nav-link <?= $adminSection==='inventory'?'active':'' ?>">📦 Inventory</a>
    </div>

    <div class="admin-nav-section">
      <div class="admin-nav-label">Sales</div>
      <a href="/admin/pages/orders.php"     class="admin-nav-link <?= $adminSection==='orders'?'active':'' ?>">🧾 Orders</a>
      <a href="/admin/pages/coupons.php"    class="admin-nav-link <?= $adminSection==='coupons'?'active':'' ?>">🏷️ Coupons</a>
    </div>

    <div class="admin-nav-section">
      <div class="admin-nav-label">Users</div>
      <a href="/admin/pages/customers.php"  class="admin-nav-link <?= $adminSection==='customers'?'active':'' ?>">👤 Customers</a>
      <a href="/admin/pages/reviews.php"    class="admin-nav-link <?= $adminSection==='reviews'?'active':'' ?>">⭐ Reviews</a>
    </div>

    <div class="admin-nav-section">
      <div class="admin-nav-label">Content</div>
      <a href="/admin/pages/banners.php"    class="admin-nav-link <?= $adminSection==='banners'?'active':'' ?>">🖼️ Banners</a>
      <a href="/admin/pages/newsletter.php" class="admin-nav-link <?= $adminSection==='newsletter'?'active':'' ?>">✉️ Newsletter</a>
    </div>

    <div class="admin-nav-section">
      <div class="admin-nav-label">System</div>
      <a href="/admin/pages/settings.php"   class="admin-nav-link <?= $adminSection==='settings'?'active':'' ?>">⚙️ Settings</a>
      <a href="/index.php" target="_blank"  class="admin-nav-link">🔗 View Store</a>
      <a href="/auth/logout.php"            class="admin-nav-link" style="color:var(--danger)">→ Sign Out</a>
    </div>
  </nav>
</aside>

<!-- ===== MAIN ===== -->
<main class="admin-main">
<div class="admin-topbar">
  <h1><?= e($adminTitle) ?></h1>
  <div style="display:flex;align-items:center;gap:1rem">
    <span style="font-size:0.8rem;color:var(--text-muted)"><?= date('l, d M Y') ?></span>
    <a href="/pages/account.php" class="btn btn-ghost btn-sm">My Profile</a>
  </div>
</div>
