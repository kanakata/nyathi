<?php

namespace App\Http\Controllers;

use App\Models\ProductsModel;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    private $perPage = 9;
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
            "currentPage" => $currentPage,
            "perPage" => $this->perPage,
            "totalPages" => $totalPages,
            "product_cumulative" => $product_cumulative,
        ]);
    }
    public function page(int $id)
    {
        $products = ProductsModel::collect_products_paginated($this->perPage, ($this->perPage * $id) - $this->perPage);
        $total = ProductsModel::product_count();
        $currentPage = (int) ($id ?? 1);
        $product_cumulative = $currentPage * $this->perPage > $total ? $total : $currentPage * $this->perPage;
        $totalPages = (int) ceil($total / $this->perPage);
        return view("user.pages.shop", [
            "products" => $products,
            "total" => $total,
            "currentPage" => $currentPage,
            "perPage" => $this->perPage,
            "totalPages" => $totalPages,
            "product_cumulative" => $product_cumulative,
        ]);
    }

    public function category(string $category)
    {
        $id = 1;
        $products = ProductsModel::collect_categorized_products_paginated(str_replace(["+"], " ", $category), $this->perPage, ($this->perPage * $id) - $this->perPage);
        $total = count($products);
        $currentPage = (int) ($id ?? 1);
        $product_cumulative = $currentPage * $this->perPage > $total ? $total : $currentPage * $this->perPage;
        $totalPages = (int) ceil($total / $this->perPage);
        return view("user.pages.shop", [
            "products" => $products,
            "total" => $total,
            "currentPage" => $currentPage,
            "perPage" => $this->perPage,
            "totalPages" => $totalPages,
            "product_cumulative" => $product_cumulative,
        ]);
    }
}
