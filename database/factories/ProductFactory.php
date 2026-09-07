<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<ProductFactory>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            "boots",
            "fan kit",
            "training kit",
            "shorts",
            "tracksuits",
            "socks",
            "headgear",
            "protective gear",
        ];

        $brand = [
            "nike",
            "adidas",
            "canterbury",
            "rebook",
            "new balance",
            "samurai",
        ];

        $sizes = [
            'XS',
            'S',
            'M',
            'L',
            'XL',
            'XXL',
        ];

        $images = [
            "IMG-20260829-WA0000.jpg",
            "IMG-20260829-WA0000.jpg",
            "IMG-20260829-WA0001.jpg",
            "IMG-20260829-WA0000.jpg",
            "IMG-20260829-WA0001.jpg",
        ];

        return [
            "product_name" => Str::random(10),
            "product_description" => fake()->sentence(7),
            "product_category" => fake()->randomElement($categories),
            "product_brand" => fake()->randomElement($brand),
            "product_cupon" => strtoupper(Str::random(5)),
            "product_color" => fake()->colorName(),
            "product_price" => fake()->numberBetween(100, 10000),
            "product_count" => fake()->numberBetween(1, 200),
            "product_discount" => fake()->numberBetween(1, 100),
            "product_sizes" => implode(",", $sizes),
            "product_rating" => fake()->numberBetween(1, 5),
            "product_image" => "IMG-20260829-WA0000.jpg",
            "product_images" => implode(",", $images),
        ];
    }
}
