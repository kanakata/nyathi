<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ProductsModel;

class LandingController extends Controller
{
    public function index()
    {

        return view('user.pages.landing', ['featured' => ProductsModel::featured(), 'categories' => $this->categories()]);

    }
}
