<?php

namespace App\Http\Controllers;

use App\Models\ProductsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ShopController extends Controller
{
    private int $perPage = 9;

    private function categories_count()
    {
        $categories = ProductsModel::categories();
        $categories_temp = [];
        $categories_count = [];
        foreach ($categories as $category) {
            array_push($categories_temp, $category->product_category);
            array_push($categories_count, ProductsModel::categories_count($category->product_category));
        }
        return array_combine($categories_temp, $categories_count);
    }

    public function filter(string $category)
    {
        $page = $page ?? 1;
        $data = ProductsModel::collect_categorized_products_paginated(category: str_replace(["+"], " ", $category), perPage: $this->perPage, offset: ($this->perPage * $page) - $this->perPage);
        $products = $data['data'];
        $total = $data['count'];
        $currentPage = (int) ($page ?? 1);
        $product_cumulative = $currentPage * $this->perPage > $total ? $total : $currentPage * $this->perPage;
        $totalPages = (int) ceil($total / $this->perPage);
        return json_encode([
            "products" => $products,
            "total" => $total,
            "currentPage" => $currentPage,
            "perPage" => $this->perPage,
            "totalPages" => $totalPages,
            "product_cumulative" => $product_cumulative,
            "category" => $category,
            "categories" => $this->categories_count(),
        ]);
    }
    public function index()
    {
        $offset = 0;
        $products = ProductsModel::collect_products_paginated($this->perPage, $offset);
        $total = ProductsModel::product_count();
        $currentPage = (int) ($_GET['page'] ?? 1);
        $product_cumulative = $currentPage * $this->perPage > $total ? $total : $currentPage * $this->perPage;
        $totalPages = (int) ceil($total / $this->perPage);
        return view("user.pages.shop", [
            "products" => $products,
            "total" => $total,
            "current_page" => $currentPage,
            "per_page" => $this->perPage,
            "total_pages" => $totalPages,
            "product_cumulative" => $product_cumulative,
            "categories" => $this->categories_count(),
        ]);
    }
    public function page(int $page = 1)
    {
        $page = $page ?? 1;
        $products = ProductsModel::collect_products_paginated($this->perPage, ($this->perPage * $page) - $this->perPage);
        $total = ProductsModel::product_count();
        $currentPage = (int) ($page ?? 1);
        $product_cumulative = $currentPage * $this->perPage > $total ? $total : $currentPage * $this->perPage;
        $totalPages = (int) ceil($total / $this->perPage);
        $products_id = [];

        foreach ($products as $product) {
            array_push($products_id, Crypt::encryptString($product->id));
            unset($product->id);
        }

        return  json_encode([
            "products" => $products,
            "products_id" => $products_id,
            "total" => $total,
            "current_page" => $currentPage,
            "per_page" => $this->perPage,
            "total_pages" => $totalPages,
            "product_cumulative" => $product_cumulative,
            "categories" => $this->categories_count(),
        ]);
    }
    public function category(string $category, int $page = 1)
    {
        $page = $page ?? 1;
        $data = ProductsModel::collect_categorized_products_paginated(category: str_replace(["+"], " ", $category), perPage: $this->perPage, offset: ($this->perPage * $page) - $this->perPage);
        $products = $data['data'];
        $total = $data['count'];
        $currentPage = (int) ($page ?? 1);
        $product_cumulative = $currentPage * $this->perPage > $total ? $total : $currentPage * $this->perPage;
        $totalPages = (int) ceil($total / $this->perPage);
        return view("user.pages.shop", [
            "products" => $products,
            "total" => $total,
            "currentPage" => $currentPage,
            "perPage" => $this->perPage,
            "totalPages" => $totalPages,
            "product_cumulative" => $product_cumulative,
            "category" => $category,
            "categories" => $this->categories_count(),
        ]);
    }
}
