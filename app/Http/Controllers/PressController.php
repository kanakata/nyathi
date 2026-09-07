<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PressController extends Controller
{
    public function index()
    {
        return view("user.pages.press");
    }
}
