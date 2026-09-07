<x-admin.header></x-admin.header>

<!-- Stat Cards -->
<div class="stat-cards">
    @foreach ($stats as $s)
        <div class="stat-card">
            <div class="stat-label">{{ e($s['label']) }}</div>
            <div class="stat-value">{{ e($s['value']) }}</div>
            <div class="stat-change {{ $s['dir'] }}">
                {{ $s['dir'] === 'up' ? '↑' : '↓' }} {{ e($s['change']) }} this month
            </div>
        </div>
    @endforeach
</div>

<!-- Chart Placeholder -->
<div style="display:grid;grid-template-columns:2fr 1fr;gap:1.5rem;margin-bottom:2rem">
    <div class="chart-box">
        <h4>Revenue Overview</h4>
        {{-- <div class="chart-placeholder">📈 Connect your analytics backend to render charts here</div> --}}
        <canvas id="bar-revenue"></canvas>
    </div>
    <div class="chart-box">
        <h4>Sales by Category</h4>
        {{-- <div class="chart-placeholder">🥧 Pie chart</div> --}}
        <canvas id="pie-revenue"></canvas>
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
                @foreach ($recentOrders as $order)
                    <tr>
                        <td>{{ e($order['id']) }}</td>
                        <td>{{ e($order['customer']) }}</td>
                        <td>{{ price($order['total']) }}</td>
                        <td><span class="order-status status-{{ $order['status'] }}">{{ ucfirst($order['status']) }}</span>
                        </td>
                        <td>{{ e($order['date']) }}</td>
                        <td><a href="/admin/pages/order-detail.php?id={{ urlencode($order['id']) }}"
                                class="btn btn-ghost btn-sm">View</a>
                        </td>
                    </tr>
                @endforeach
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
            <tr>
                <th>Product</th>
                <th>Units Sold</th>
                <th>Revenue</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($topProducts as $p)
                <tr>
                    <td>{{ e($p['name']) }}</td>
                    <td>{{ $p['sold'] }}</td>
                    <td>{{ price($p['revenue']) }}</td>
                    <td>
                        <span class="stock-badge {{ $p['stock'] <= 5 ? 'stock-low' : 'stock-in' }}">
                            {{ $p['stock'] }} left
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</main>
<x-admin.footer></x-admin.footer>
