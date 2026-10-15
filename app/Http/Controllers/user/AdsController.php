<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    public function promo() {
        $promos = collect([
            "Free shipping on orders over Ksh: 13000 New arrivals every week",
            "Safari sevens",
            "Dala sevens"
            ]
        );
        return $promos->random();
    }
}
