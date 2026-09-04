<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $featured = [
            ['id' => 1, 'name' => 'Cashmere Blend Coat', 'slug' => 'cashmere-blend-coat', 'price' => 389, 'old_price' => 520, 'image' => '/assets/images/products/p1.jpg', 'category' => 'Outerwear', 'rating' => 4.8, 'review_count' => 124, 'badge' => 'sale'],
            ['id' => 2, 'name' => 'Silk Evening Gown', 'slug' => 'silk-evening-gown', 'price' => 290, 'image' => '/assets/images/products/p2.jpg', 'category' => 'Dresses', 'rating' => 4.9, 'review_count' => 87, 'badge' => 'new'],
            ['id' => 3, 'name' => 'Structured Leather Bag', 'slug' => 'structured-leather-bag', 'price' => 445, 'image' => '/assets/images/products/p3.jpg', 'category' => 'Accessories', 'rating' => 4.7, 'review_count' => 56, 'badge' => null],
            ['id' => 4, 'name' => 'Linen Wide-Leg Trousers', 'slug' => 'linen-wide-leg-trousers', 'price' => 175, 'image' => '/assets/images/products/p4.jpg', 'category' => 'Bottoms', 'rating' => 4.5, 'review_count' => 203, 'badge' => null],
        ];
        return view("user.pages.landing", ["featured" => $featured]);
    }
}
