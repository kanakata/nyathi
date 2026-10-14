<x-utils.config></x-utils.config>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/app.css">
    <style>
        .account-layout {
            display: grid;
            grid-template-columns: 240px 1fr;
            gap: 3rem;
            align-items: start;
        }

        .account-nav {
            position: sticky;
            top: 90px;
        }

        .account-nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.85rem 1rem;
            border-radius: var(--radius);
            font-size: 0.85rem;
            color: var(--text-muted);
            transition: var(--transition);
            cursor: pointer;
        }

        .account-nav-item:hover,
        .account-nav-item.active {
            background: var(--surface);
            color: var(--gold);
        }

        .account-nav-item .icon {
            width: 16px;
            text-align: center;
        }

        .orders-table {
            width: 100%;
            border-collapse: collapse;
        }

        .orders-table th {
            text-align: left;
            font-size: 0.7rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-muted);
            padding: 0.75rem 1rem;
            border-bottom: 1px solid var(--border);
        }

        .orders-table td {
            padding: 1rem;
            font-size: 0.85rem;
            border-bottom: 1px solid var(--border);
        }

        .order-status {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.68rem;
            font-weight: 500;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .status-delivered {
            background: rgba(39, 174, 96, 0.15);
            color: var(--success);
        }

        .status-processing {
            background: rgba(201, 169, 110, 0.15);
            color: var(--gold);
        }

        .status-shipped {
            background: rgba(52, 152, 219, 0.15);
            color: #3498db;
        }

        .status-cancelled {
            background: rgba(192, 57, 43, 0.15);
            color: var(--danger);
        }

        .contact {
            display: grid;
            grid-template-columns: 1fr 1.4fr;
            gap: 5rem;
            align-items: start;

            & .card {
                padding: 2.5rem;
            }
        }
    </style>
</head>

<body>
    <?php
$pageTitle = 'My Account — Luxe Shop';
$activePage = '';
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
                    <a href="/user/logout" class="account-nav-item" style="margin-top:2rem;color:var(--danger)"><span
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
    <script src="/js/utils.js"></script>
    <script src="/js/app.js"></script>
</body>

</html>
