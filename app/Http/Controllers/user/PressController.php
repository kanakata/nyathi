<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

class PressController 
{
    public function index()
    {
        return view("user.pages.press");
    }
}
