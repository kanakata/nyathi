<?php

namespace App\Http\Controllers;

use App\Models\ProductsModel;

abstract class Controller
{
    private int $per_page = 30;
    protected function categories()
    {
        return ProductsModel::categories();
    }

    protected function avail_products(string $view)
    {
        $offset = 0;
        $data = ProductsModel::fetch_products($this->per_page, $offset);
        $products = $data['data'];
        $total = $data['count'];
        $current_page = (int) ($_GET['page'] ?? 1);
        $product_cumulative = $current_page * $this->per_page > $total ? $total : $current_page * $this->per_page;
        $total_pages = (int) ceil($total / $this->per_page);
        dd($view);
        return view($view, [
            "products" => $products,
            "total" => $total,
            "current_page" => $current_page,
            "per_page" => $this->per_page,
            "total_pages" => $total_pages,
            "product_cumulative" => $product_cumulative,
            "categories" => $this->pass_categories_count(),
        ]);
    }
    protected function pass_categories_count()
    {
        $categories = ProductsModel::categories();
        $categories_temp = $categories_count = [];
        foreach ($categories as $category) {
            array_push($categories_temp, $category->product_category);
            array_push($categories_count, ProductsModel::categories_count($category->product_category));
        }
        return array_combine($categories_temp, $categories_count);
    }
}
