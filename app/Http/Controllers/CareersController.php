<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CareersController extends Controller
{
    public function index()
    {

        $faqs = [
            'Hiring' => [
                ['q' => 'Whom do we hire?', 'a' => 'anyone.'],
            ],
        ];

        return view("user.pages.careers", ["faqs" => $faqs]);
    }
}
