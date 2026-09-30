<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

class WishlistController
{
    public function index()
    {
        return view("user.pages.wishlist");
    }
}
