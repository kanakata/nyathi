<x-utils.config></x-utils.config>
@php
    $adminTitle = $adminTitle ?? 'Dashboard';
    $adminSection = $adminSection ?? '';
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ e($adminTitle) }} — Nyathi Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;600&family=Jost:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <script src="/js/chart.umd.min.js"></script>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/admin.css">
</head>

<body class="admin-body">

    <div class="admin-layout">

        <!-- ===== SIDEBAR ===== -->
        <aside class="admin-sidebar">
            <div class="admin-logo">
                <a href="/admin/dashboard" class="logo" style="font-size:1.1rem">Nyathi<span>.</span> <small
                        style="font-size:0.55rem;letter-spacing:0.15em;color:var(--text-muted);vertical-align:super">ADMIN</small></a>
            </div>

            <nav>
                <div class="admin-nav-section">
                    <div class="admin-nav-label">Overview</div>
                    <a href="/admin/dashboard"
                        class="admin-nav-link {{ $adminSection === 'dashboard' ? 'active' : '' }}">📊 Dashboard</a>
                    <a href="/admin/analytics"
                        class="admin-nav-link {{ $adminSection === 'dashboard' ? 'active' : '' }}">📊 Analytics</a>

                </div>

                <div class="admin-nav-section">
                    <div class="admin-nav-label">Catalogue</div>
                    <a href="/admin/products"
                        class="admin-nav-link {{ $adminSection === 'products' ? 'active' : '' }}">🛍️ Products</a>
                    <a href="/admin/product-form"
                        class="admin-nav-link {{ $adminSection === 'products' ? 'active' : '' }}">🛍️ Product form</a>

                </div>

                <div class="admin-nav-section">
                    <div class="admin-nav-label">Sales</div>
                    <a href="/admin/orders" class="admin-nav-link {{ $adminSection === 'orders' ? 'active' : '' }}">🧾
                        Orders</a>

                </div>

                <div class="admin-nav-section">
                    <div class="admin-nav-label">Users</div>
                    <a href="/admin/customers"
                        class="admin-nav-link {{ $adminSection === 'customers' ? 'active' : '' }}">
                        👤 Customers</a>
                </div>

                <div class="admin-nav-section">
                    <div class="admin-nav-label">Content</div>
                </div>

                <div class="admin-nav-section">
                    <div class="admin-nav-label">System</div>
                    <a href="/admin/settings"
                        class="admin-nav-link {{ $adminSection === 'settings' ? 'active' : '' }}">⚙️ Settings</a>
                    <a href="/" target="_blank" class="admin-nav-link">🔗 View Store</a>
                    <a href="/admin/logout" class="admin-nav-link" style="color:var(--danger)">→ Sign Out</a>
                </div>
            </nav>
        </aside>

        <!-- ===== MAIN ===== -->
        <main class="admin-main">
            <div class="admin-topbar">
                <h1>{{ e($adminTitle) }}</h1>
                <div style="display:flex;align-items:center;gap:1rem">
                    <span style="font-size:0.8rem;color:var(--text-muted)">{{ date('l, d M Y') }}</span>
                    <a href="/admin/account" class="btn btn-ghost btn-sm">My Profile</a>
                </div>
            </div>
