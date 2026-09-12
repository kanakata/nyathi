<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductsModel extends Model
{
    public static function categories($default = "landing")
    {
        if ($default == "landing") {
            return DB::table("products")->select("product_category")->distinct()->limit(7)->get();
        } else {
            return DB::table("products")->select("product_category")->distinct()->get();
        }
    }
    public static function featured()
    {
        return DB::table("products")->select()->where("product_rating", ">", 4)->limit(4)->get();
    }
    public static function product_count()
    {
        return DB::table("products")->count();
    }
    public static function categories_count(string $category)
    {
        return DB::table("products")->where("product_category", "=", $category)->count();
    }
    public static function collect_product(int $id)
    {
        return DB::table("products")->select("*")->where("id", "=", $id)->get();
    }
    public static function collect_product_related(int $id)
    {
        return DB::table("products")->select("*")->where("product_category", "=", DB::table("products")->select("product_category")->where("id", "=", $id)->get()[0]->product_category)->limit(4)->get();
    }
    public static function collect_product_filter_price(int $price, int $perPage, int $offset)
    {
        return [
            "data" => DB::table("products")->select()->where("product_price", "<=", $price)->limit($perPage)->offset($offset)->get(),
            "count" => DB::table("products")->select()->where("product_price", "<=", $price)->count(),
        ];
    }
    public static function collect_product_related_filter_price(int $price, string $category, int $perPage)
    {
        return [
            "data" => DB::table("products")->select()->where("product_price", "<=", $price)->paginate($perPage),
            "count" => DB::table("products")->select()->where("product_category", "=", $category)->count(),
        ];
    }
    public static function collect_products_paginated(int $perPage, int $offset)
    {
        return [
            "data" => DB::table("products")->limit($perPage)->offset($offset)->get(),
            "count" => DB::table("products")->count()
        ];
    }
    public static function collect_categorized_products_paginated(string $category, int $perPage, int $offset)
    {
        return [
            "data" => DB::table("products")->where("product_category", "=", $category)->limit($perPage)->offset($offset)->get(),
            "count" => DB::table("products")->select()->where("product_category", "=", $category)->count(),
        ];
    }
}
