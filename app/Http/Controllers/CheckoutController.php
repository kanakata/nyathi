<?php

namespace App\Http\Controllers;

use App\Models\CheckoutModel;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("user.cart.checkout");
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
    public function show(CheckoutModel $checkoutModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CheckoutModel $checkoutModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CheckoutModel $checkoutModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CheckoutModel $checkoutModel)
    {
        //
    }
}
