<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function categories()
    {
        return [
            ['name' => 'Fan kits', 'slug' => 'women', 'count' => 240, 'image' => '/assets/images/IMG-20260822-WA0028.jpg', 'desc' => 'Bangles Tops, Outerwear & more'],
            ['name' => 'Shorts', 'slug' => 'men', 'count' => 180, 'image' => '/assets/images/IMG-20260902-WA0035.jpg', 'desc' => 'Shorts'],
            ['name' => 'Accessories', 'slug' => 'accessories', 'count' => 90, 'image' => '/assets/images/IMG-20260822-WA0024.jpg', 'desc' => 'Bags, Jewellery, Belts & more'],
            ['name' => 'Training kits', 'slug' => 'home', 'count' => 60, 'image' => '/assets/images/IMG-20260822-WA0014.jpg', 'desc' => 'Vests, Tracks & more'],
            ['name' => 'Footwear', 'slug' => 'footwear', 'count' => 75, 'image' => '/assets/images/IMG-20260822-WA0015.jpg', 'desc' => 'Boots, Trainers & more'],
        ];
    }
}
