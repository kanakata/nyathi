<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SizeGuideController extends Controller
{
    public function index()
    {
        $measures = [
            ['Bust / Chest', 'Measure around the fullest part of your chest, keeping the tape parallel to the floor.'],
            ['Waist', 'Measure around your natural waist — the narrowest point, usually just above your navel.'],
            ['Hips', 'Stand with feet together and measure around the fullest part of your hips and seat.'],
        ];
        $menSizes = [
            ['XS', '44', '34', '84-87', '70-73', '86-89'],
            ['S', '46', '36', '88-91', '74-77', '90-93'],
            ['M', '48', '38', '92-95', '78-81', '94-97'],
            ['L', '50', '40', '96-99', '82-85', '98-101'],
            ['XL', '52', '42', '100-104', '86-90', '102-106'],
            ['XXL', '54', '44', '105-109', '91-95', '107-111'],
        ];
        $womenSizes = [
            ['XS', '32', '6', '80-83', '60-63', '86-89'],
            ['S', '34', '8', '84-87', '64-67', '90-93'],
            ['M', '36', '10', '88-91', '68-71', '94-97'],
            ['L', '38', '12', '92-95', '72-75', '98-101'],
            ['XL', '40', '14', '96-99', '76-79', '102-105'],
            ['XXL', '42', '16', '100-105', '80-85', '106-111'],
        ];
        return view("user.pages.size-guide", ["measures" => $measures, "menSizes" => $menSizes, "womenSizes" => $womenSizes]);
    }
}
