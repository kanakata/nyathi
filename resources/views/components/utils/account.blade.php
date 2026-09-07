<?php
/**
 * LUXE SHOP — My Account Page
 */
// require_once __DIR__ . '/../includes/config';
// if (!isLoggedIn()) redirect('/auth/login?redirect=/pages/account');

$pageTitle = 'My Account — Luxe Shop';
$activePage = '';

// Placeholder user & orders
$user = ['first_name' => 'Amara', 'last_name' => 'Osei', 'email' => 'amara@example.com', 'joined' => 'January 2024'];
$orders = [
    ['id' => 'LX-A4F1E2', 'date' => 'Mar 15, 2025', 'total' => 389.00, 'status' => 'delivered', 'items' => 1],
    ['id' => 'LX-B8D3F7', 'date' => 'Feb 28, 2025', 'total' => 220.00, 'status' => 'shipped', 'items' => 2],
    ['id' => 'LX-C2E9A1', 'date' => 'Jan 12, 2025', 'total' => 655.00, 'status' => 'delivered', 'items' => 3],
];

?>
<div class="page-hero">
    <div class="container">
        <h1>My Account</h1>
        <p style="color:var(--text-muted);margin-top:0.5rem">Welcome back, <?= e($user['first_name']) ?></p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="account-layout">

            <!-- ===== SIDEBAR NAV ===== -->
            <nav class="account-nav">
                <a href="#orders" class="account-nav-item active"><span class="icon">📦</span> Orders</a>
                <a href="#wishlist" class="account-nav-item"><span class="icon">♡</span> Wishlist</a>
                <a href="#profile" class="account-nav-item"><span class="icon">◉</span> Profile</a>
                <a href="#address" class="account-nav-item"><span class="icon">◈</span> Addresses</a>
                <a href="#password" class="account-nav-item"><span class="icon">✦</span> Security</a>
                <a href="/auth/logout" class="account-nav-item" style="margin-top:2rem;color:var(--danger)"><span
                        class="icon">→</span> Sign Out</a>
            </nav>

            <!-- ===== MAIN CONTENT ===== -->
            <div>

                <!-- Orders -->
                <div id="orders" class="card" style="margin-bottom:2rem;overflow:visible">
                    <div style="padding:1.5rem 2rem;border-bottom:1px solid var(--border)">
                        <h3 style="font-size:1.1rem">Order History</h3>
                    </div>
                    <div style="overflow-x:auto">
                        <table class="orders-table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Date</th>
                                    <th>Items</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td><?= e($order['id']) ?></td>
                                        <td><?= e($order['date']) ?></td>
                                        <td><?= $order['items'] ?> item<?= $order['items'] > 1 ? 's' : '' ?></td>
                                        <td><?= price($order['total']) ?></td>
                                        <td><span
                                                class="order-status status-<?= $order['status'] ?>"><?= ucfirst($order['status']) ?></span>
                                        </td>
                                        <td><a href="/order-detail?id=<?= urlencode($order['id']) ?>"
                                                class="btn btn-ghost btn-sm">View</a></td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Profile -->
                <div id="profile" class="card" style="padding:2rem;margin-bottom:2rem">
                    <h3 style="font-size:1.1rem;margin-bottom:1.5rem">Profile Information</h3>
                    <form method="POST" action="/pages/update-profile">
                        <div class="form-row">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="first_name" class="form-control"
                                    value="<?= e($user['first_name']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="last_name" class="form-control"
                                    value="<?= e($user['last_name']) ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="email" class="form-control" value="<?= e($user['email']) ?>"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="tel" name="phone" class="form-control" placeholder="+254 700 000 000">
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>

                <!-- Change Password -->
                <div id="password" class="card" style="padding:2rem">
                    <h3 style="font-size:1.1rem;margin-bottom:1.5rem">Change Password</h3>
                    <form method="POST" action="/auth/change-password">
                        <div class="form-group">
                            <label>Current Password</label>
                            <input type="password" name="current_password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="new_password" class="form-control" minlength="8" required>
                        </div>
                        <div class="form-group">
                            <label>Confirm New Password</label>
                            <input type="password" name="confirm_password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Password</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>
