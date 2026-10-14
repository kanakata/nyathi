<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AccountModel;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = ['first_name' => 'Amara', 'last_name' => 'Osei', 'email' => 'amara@example.com', 'joined' => 'January 2024'];
        $orders = [
            ['id' => 'LX-A4F1E2', 'date' => 'Mar 15, 2025', 'total' => 389.00, 'status' => 'delivered', 'items' => 1],
            ['id' => 'LX-B8D3F7', 'date' => 'Feb 28, 2025', 'total' => 220.00, 'status' => 'shipped', 'items' => 2],
            ['id' => 'LX-C2E9A1', 'date' => 'Jan 12, 2025', 'total' => 655.00, 'status' => 'delivered', 'items' => 3],
        ];

        return view('user.pages.account', ['user' => $user, 'orders' => $orders]);
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
    public function show(AccountModel $accountModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AccountModel $accountModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AccountModel $accountModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AccountModel $accountModel)
    {
        //
    }
}
