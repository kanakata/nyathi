<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

class LoginController
{
    public function index()
    {
        return view("user.auth.login");
    }
}
