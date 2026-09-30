<?php

namespace App\Http\Controllers\admin;

use App\Models\ProductsModel;

class ProductsController
{
    private int $per_page = 30;

    public function pass_products()
    {
        $offset = 0;
        $data = ProductsModel::fetch_products($this->per_page, $offset);
        $products = $data['data'];
        $total = $data['count'];
        $current_page = (int) ($_GET['page'] ?? 1);
        $product_cumulative = $current_page * $this->per_page > $total ? $total : $current_page * $this->per_page;
        $total_pages = (int) ceil($total / $this->per_page);

        return view('admin.products', [
            'products' => $products,
            'total' => $total,
            'current_page' => $current_page,
            'per_page' => $this->per_page,
            'total_pages' => $total_pages,
            'product_cumulative' => $product_cumulative,
            'categories' => $this->pass_categories_count(),
        ]);
        // dd($products);
    }
}
