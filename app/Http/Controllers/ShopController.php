<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $products = array_fill(0, 12, [
            'id' => 1,
            'name' => 'Silk Blend Blouse',
            'slug' => 'silk-blend-blouse',
            'price' => 220,
            'old_price' => null,
            'image' => '/assets/images/IMG-20260822-WA0023.jpg',
            'category' => 'Tops',
            'rating' => 4.6,
            'review_count' => 34,
            'badge' => null,
        ]);
        $total = 48;
        $currentPage = (int) ($_GET['page'] ?? 1);
        $perPage = 12;
        $totalPages = (int) ceil($total / $perPage);
        return view("user.pages.shop", [
            "products" => $products,
            "total" => $total,
            "currentPage" => $currentPage,
            "perPage" => $perPage,
            "totalPages" => $totalPages
        ]);
    }
}
