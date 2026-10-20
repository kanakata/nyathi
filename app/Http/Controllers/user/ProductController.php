<?php

namespace App\Http\Controllers\User;

use App\Models\ProductsModel;
use Exception;
use Illuminate\Http\Request;

class ProductController
{
    public function pass_product(string $id)
    {

        try {
            $product = ProductsModel::fetch_product($id)[0];

            $stars = str_repeat('★', round($product->product_rating)).str_repeat('☆', 5 - round($product->product_rating));
            $related = ProductsModel::fetch_related_products($id);

            return view('user.pages.product', ['product' => $product, 'stars' => $stars, 'related' => $related]);
        } catch (Exception $e) {
            if ($e->getMessage() == 'The payload is invalid.') {
                return redirect('/user/shop');
            }
        }
    }

    public function process_order(Request $request)
    {
        return view('user.cart.order-confirmation');
    }
}
