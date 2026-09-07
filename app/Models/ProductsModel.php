<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductsModel extends Model
{
    public static function categories()
    {
        return DB::table("products")->select("product_category", "product_image", "product_count", "product_description", "product_name")->distinct()->limit(7)->get();
    }
    public static function featured()
    {
        return DB::table("products")->select()->where("product_rating", ">", 4)->limit(4)->get();
    }
    public static function product_count()
    {
        return DB::table("products")->count();
    }
    public static function collect_product(int $id)
    {
        return DB::table("products")->select("*")->where("id", "=", $id)->get();
    }
    public static function collect_product_related(int $id)
    {
        return DB::table("products")->select("*")->where("product_category", "=", DB::table("products")->select("product_category")->where("id", "=", $id)->get()[0]->product_category)->limit(4)->get();
    }
    public static function collect_products_paginated(int $perPage, int $offset)
    {
        return DB::table("products")->limit($perPage)->offset($offset)->get();
    }
    public static function collect_categorized_products_paginated(string $category, int $perPage, int $offset)
    {
        return DB::table("products")->where("product_category", "=", $category)->limit($perPage)->offset($offset)->get();
    }
}
