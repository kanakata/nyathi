<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function index()
    {
        $methods = [
            ['label' => 'Standard', 'time' => '5–7 Business Days', 'cost' => 'Free over $150 · $9.99 otherwise'],
            ['label' => 'Express', 'time' => '2–3 Business Days', 'cost' => '$19.99'],
            ['label' => 'Overnight', 'time' => 'Next Business Day', 'cost' => '$34.99'],
        ];
        return view("user.pages.shipping", ["methods" => $methods]);
    }
}
