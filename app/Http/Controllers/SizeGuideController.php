<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SizeGuideController extends Controller
{
    public function index(){
        return view("user.pages.size-guide");
    }
}
