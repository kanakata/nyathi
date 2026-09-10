<?php

namespace App\Http\Controllers;

use App\Models\ProductsModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProductController extends Controller
{
    public function  index(string $id)
    {
        try {
            $product = ProductsModel::collect_product(Crypt::decryptString($id))[0];
            $stars = str_repeat('★', round($product->product_rating)) . str_repeat('☆', 5 - round($product->product_rating));
            $related = ProductsModel::collect_product_related(Crypt::decryptString($id));
            return view("user.pages.product", ["product" => $product, "stars" => $stars, "related" => $related]);
        } catch (Exception $e) {
            if ($e->getMessage() == "The payload is invalid.") {
                return redirect("/user/shop");
            }
        };
    }
}
