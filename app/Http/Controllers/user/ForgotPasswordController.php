<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

class ForgotPasswordController
{
    public function index(){
        return view("user.auth.forgot-password");
    }
}
