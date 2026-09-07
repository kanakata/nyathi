<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $team = [
            ['name' => 'Zara Omondi',  'role' => 'Founder & Creative Director'],
            ['name' => 'David Kimani', 'role' => 'Head of Operations'],
            ['name' => 'Aisha Mwangi', 'role' => 'Head of Design'],
            ['name' => 'Seun Adeyemi', 'role' => 'Brand & Marketing'],
        ];
        return view("user.pages.about", ["team" => $team]);
    }
}
