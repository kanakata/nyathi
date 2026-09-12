<?php

namespace App\Http\Controllers;

use App\Models\ProductsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ShopController extends Controller
{
    private int $perPage = 6;

    private function fetchProducts(callable $callback, int $page, string $category = "", $paginate = false)
    {
        $data = $callback();
        $products = $data['data'];
        $total = $data['count'];
        $current_page = (int) ($page ?? 1);
        $product_cumulative = $current_page * $this->perPage > $total ? $total : $current_page * $this->perPage;
        $total_pages = (int) ceil($total / $this->perPage);

        $products_id = [];
        foreach ($products as $product) {
            array_push($products_id, Crypt::encryptString($product->id));
            unset($product->id);
        }

        $json_response = [
            "products" => $products,
            "total" => $total,
            "current_page" => $current_page,
            "per_page" => $this->perPage,
            "total_pages" => $total_pages,
            "product_cumulative" => $product_cumulative,
            "categories" => $this->categoriesCount(),
            "products_id" => $products_id,
        ];

        return response()->json($paginate ? array_merge($json_response, ["category" => $category]) : $json_response);
    }
    private function categoriesCount()
    {
        $categories = ProductsModel::categories();
        $categories_temp = $categories_count = [];
        foreach ($categories as $category) {
            array_push($categories_temp, $category->product_category);
            array_push($categories_count, ProductsModel::categories_count($category->product_category));
        }
        return array_combine($categories_temp, $categories_count);
    }

    public function filterCategory(string $category)
    {
        $page = $page ?? 1;
        return $this->fetchProducts(function () use ($category, $page) {
            return ProductsModel::collect_categorized_products_paginated(category: str_replace(["+"], " ", $category), perPage: $this->perPage, offset: ($this->perPage * $page) - $this->perPage);
        }, $page, $category);
    }

    public function filterPrice(int $price)
    {
        $page = $page ?? 1;
        return $this->fetchProducts(function () use ($price, $page) {
            return ProductsModel::collect_product_filter_price(price: $price, perPage: $this->perPage, offset: ($this->perPage * $page) - $this->perPage);
        }, $page);
    }

    public function ajaxCategory(string $category, int $page = 1)
    {
        return $this->fetchProducts(function () use ($category, $page) {
            return ProductsModel::collect_categorized_products_paginated(category: str_replace(["+"], " ", $category), perPage: $this->perPage, offset: ($this->perPage * $page) - $this->perPage);
        }, $page, $category);
    }

    public function page(int $page = 1)
    {
        return $this->fetchProducts(function () use ($page) {
            return ProductsModel::collect_products_paginated(perPage: $this->perPage, offset: ($this->perPage * $page) - $this->perPage);
        }, $page, paginate: true);
    }

    public function index()
    {
        $offset = 0;
        $data = ProductsModel::collect_products_paginated($this->perPage, $offset);
        $products = $data['data'];
        $total = $data['count'];
        $current_page = (int) ($_GET['page'] ?? 1);
        $product_cumulative = $current_page * $this->perPage > $total ? $total : $current_page * $this->perPage;
        $total_pages = (int) ceil($total / $this->perPage);

        return view("user.pages.shop", [
            "products" => $products,
            "total" => $total,
            "current_page" => $current_page,
            "per_page" => $this->perPage,
            "total_pages" => $total_pages,
            "product_cumulative" => $product_cumulative,
            "categories" => $this->categoriesCount(),
        ]);
    }

    public function category(string $category, int $page = 1)
    {
        $page = $page ?? 1;
        $data = ProductsModel::collect_categorized_products_paginated(category: str_replace(["+"], " ", $category), perPage: $this->perPage, offset: ($this->perPage * $page) - $this->perPage);
        $products = $data['data'];
        $total = $data['count'];
        $current_page = (int) ($page ?? 1);
        $product_cumulative = $current_page * $this->perPage > $total ? $total : $current_page * $this->perPage;
        $total_pages = (int) ceil($total / $this->perPage);

        return  view("user.pages.shop", [
            "products" => $products,
            "total" => $total,
            "current_page" => $current_page,
            "per_page" => $this->perPage,
            "total_pages" => $total_pages,
            "product_cumulative" => $product_cumulative,
            "category" => $category,
            "categories" => $this->categoriesCount(),
        ]);
    }
}
