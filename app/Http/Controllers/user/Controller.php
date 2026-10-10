<?php

namespace App\Http\Controllers\User;

class Controller
{
    public function promo()
    {
        $promos = collect(['✦ Free shipping on orders over Ksh: 13000 New arrivals every week ✦']);

        return $promos->random();
    }
}
