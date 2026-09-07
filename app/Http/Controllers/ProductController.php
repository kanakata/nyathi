<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function  index()
    {
        $product = [
            'id' => 1,
            'name' => 'Cashmere Blend Overcoat',
            'slug' => 'cashmere-blend-overcoat',
            'brand' => 'Nyathi Collection',
            'price' => 389.00,
            'old_price' => 520.00,
            'description' => 'A masterwork in refined tailoring. This double-faced cashmere blend overcoat features a clean, structured silhouette with subtle peak lapels and a half-belt at the back. The fabric drapes beautifully and provides extraordinary warmth without weight.',
            'category' => 'Outerwear',
            'sku' => 'LC-OC-001',
            'rating' => 4.8,
            'review_count' => 124,
            'in_stock' => true,
            'images' => [
                '/assets/images/IMG-20260725-WA0000.jpg',
                '/assets/images/IMG-20260725-WA0000.jpg',
                '/assets/images/IMG-20260725-WA0000.jpg',
                '/assets/images/IMG-20260725-WA0000.jpg',
            ],
            'sizes' => ['XS', 'S', 'M', 'L', 'XL'],
            'unavailable_sizes' => ['XS'],
            'colors' => ['Camel', 'Black', 'Ivory'],
            'tags' => ['coat', 'winter', 'cashmere', 'outerwear'],
        ];

        $stars = str_repeat('★', round($product['rating'])) . str_repeat('☆', 5 - round($product['rating']));

        // Placeholder related products
        $related = array_fill(0, 4, [
            'id' => 2,
            'name' => 'Wool Blazer',
            'slug' => 'wool-blazer',
            'price' => 280,
            'old_price' => null,
            'image' => '/assets/images/IMG-20260725-WA0000.jpg',
            'category' => 'Outerwear',
            'rating' => 4.5,
            'review_count' => 67,
            'badge' => 'new',
        ]);

        return view("user.pages.product", ["product" => $product, "stars" => $stars, "related" => $related]);
    }
}
