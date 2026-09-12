<?php

namespace App\Http\Controllers;

use App\Models\ProductsModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProductController extends Controller
{
    public function  pass_product(string $id)
    {
        try {
            $product = ProductsModel::fetch_product(Crypt::decryptString($id))[0];
            $stars = str_repeat('★', round($product->product_rating)) . str_repeat('☆', 5 - round($product->product_rating));
            $related = ProductsModel::fetch_related_products(Crypt::decryptString($id));
            return view("user.pages.product", ["product" => $product, "stars" => $stars, "related" => $related]);
        } catch (Exception $e) {
            if ($e->getMessage() == "The payload is invalid.") {
                return redirect("/user/shop");
            }
        };
    }
}
