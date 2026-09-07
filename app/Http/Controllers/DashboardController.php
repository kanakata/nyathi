<?php

namespace App\Http\Controllers;

use App\Models\DashboardModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stats = [
            ['label' => 'Total Revenue', 'value' => '$48,320', 'change' => '+12.4%', 'dir' => 'up'],
            ['label' => 'Orders Today', 'value' => '34', 'change' => '+5', 'dir' => 'up'],
            ['label' => 'New Customers', 'value' => '128', 'change' => '+8.1%', 'dir' => 'up'],
            ['label' => 'Avg. Order Value', 'value' => '$142', 'change' => '-2.3%', 'dir' => 'down'],
        ];

        $recentOrders = [
            ['id' => 'LX-A4F1E2', 'customer' => 'Amara Osei', 'total' => 389.00, 'status' => 'delivered', 'date' => 'Today, 09:14'],
            ['id' => 'LX-B8D3F7', 'customer' => 'James Kariuki', 'total' => 220.00, 'status' => 'processing', 'date' => 'Today, 07:52'],
            ['id' => 'LX-C2E9A1', 'customer' => 'Sofia Mendez', 'total' => 655.00, 'status' => 'shipped', 'date' => 'Yesterday'],
            ['id' => 'LX-D1F0A4', 'customer' => 'Kemi Adeyemi', 'total' => 175.00, 'status' => 'processing', 'date' => 'Yesterday'],
            ['id' => 'LX-E7B3C9', 'customer' => 'Paul Mutua', 'total' => 290.00, 'status' => 'delivered', 'date' => 'Mar 18'],
        ];

        $topProducts = [
            ['name' => 'Cashmere Blend Coat', 'sold' => 42, 'revenue' => 16338, 'stock' => 8],
            ['name' => 'Silk Evening Gown', 'sold' => 31, 'revenue' => 8990, 'stock' => 15],
            ['name' => 'Leather Tote Bag', 'sold' => 29, 'revenue' => 12905, 'stock' => 3],
            ['name' => 'Linen Trousers', 'sold' => 55, 'revenue' => 9625, 'stock' => 22],
        ];


        return view("admin.dashboard", [
            "stats" => $stats,
            "recentOrders" => $recentOrders,
            "topProducts" => $topProducts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DashboardModel $dashboardModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DashboardModel $dashboardModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DashboardModel $dashboardModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DashboardModel $dashboardModel)
    {
        //
    }
}
