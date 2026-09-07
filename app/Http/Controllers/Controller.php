<?php

namespace App\Http\Controllers;

use App\Models\ProductsModel;

abstract class Controller
{
    public function categories()
    {
        return ProductsModel::categories();
    }
}
