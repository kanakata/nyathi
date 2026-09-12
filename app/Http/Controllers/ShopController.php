<?php

namespace App\Http\Controllers;

use App\Models\ProductsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ShopController extends Controller
{
    private int $perPage = 6;

    private function avail_products(callable $callback, int $page, string $category = "", $paginate = false, int $price = 0)
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
            "categories" => $this->pass_categories_count(),
            "products_id" => $products_id,
        ];

        return response()->json($paginate ? array_merge($json_response, ["category" => $category]) : $json_response);
    }
    private function pass_categories_count()
    {
        $categories = ProductsModel::categories();
        $categories_temp = $categories_count = [];
        foreach ($categories as $category) {
            array_push($categories_temp, $category->product_category);
            array_push($categories_count, ProductsModel::categories_count($category->product_category));
        }
        return array_combine($categories_temp, $categories_count);
    }

    public function pass_products_filtered_by_category(string $category)
    {
        $page = $page ?? 1;
        return $this->avail_products(function () use ($category, $page) {
            return ProductsModel::fetch_categorized_products(category: str_replace(["+"], " ", $category), perPage: $this->perPage, offset: ($this->perPage * $page) - $this->perPage);
        }, $page, $category);
    }
    public function pass_products_filtered_by_category_and_price(string $category, int $price)
    {
        $page = $page ?? 1;
        return $this->avail_products(function () use ($category, $page, $price) {
            return ProductsModel::fetch_products_filtered_by_category_and_price(category: str_replace(["+"], " ", $category), price: $price, perPage: $this->perPage, offset: ($this->perPage * $page) - $this->perPage);
        }, page: $page, category: $category, price: $price);
    }

    public function pass_products_filtered_by_price(int $price)
    {
        $page = $page ?? 1;
        return $this->avail_products(function () use ($price, $page) {
            return ProductsModel::fetch_product_filtered_by_price(price: $price, perPage: $this->perPage, offset: ($this->perPage * $page) - $this->perPage);
        }, page: $page);
    }

    public function pass_requested_categorized_batch_of_products(string $category, int $page = 1)
    {
        return $this->avail_products(function () use ($category, $page) {
            return ProductsModel::fetch_categorized_products(category: str_replace(["+"], " ", $category), perPage: $this->perPage, offset: ($this->perPage * $page) - $this->perPage);
        }, $page, $category);
    }

    public function pass_requested_batch_of_products(int $page = 1)
    {
        return $this->avail_products(function () use ($page) {
            return ProductsModel::fetch_products(perPage: $this->perPage, offset: ($this->perPage * $page) - $this->perPage);
        }, $page, paginate: true);
    }

    public function pass_products()
    {
        $offset = 0;
        $data = ProductsModel::fetch_products($this->perPage, $offset);
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
            "categories" => $this->pass_categories_count(),
        ]);
    }

    public function pass_categorized_products(string $category, int $page = 1)
    {
        $page = $page ?? 1;
        $data = ProductsModel::fetch_categorized_products(category: str_replace(["+"], " ", $category), perPage: $this->perPage, offset: ($this->perPage * $page) - $this->perPage);
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
            "categories" => $this->pass_categories_count(),
        ]);
    }
}
