<?php

namespace App\Http\Controllers\User;
use Illuminate\Http\Request;

class CareersController 
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
