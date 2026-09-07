<?php

namespace App\Http\Controllers;

use App\Models\ProductsModel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function  index(int $id)
    {
        $product = ProductsModel::collect_product($id)[0];

        $stars = str_repeat('★', round($product->product_rating)) . str_repeat('☆', 5 - round($product->product_rating));

        $related = ProductsModel::collect_product_related($id);

        return view("user.pages.product", ["product" => $product, "stars" => $stars, "related" => $related]);
    }
}
