<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carousel;

class DashboardController extends Controller
{
    // public function index()
    // {
    //     $carouselItems = Carousel::all();
    //     return view('dashboard', compact('carouselItems'));
    // }
    public function index()
    {
        $carouselItems = Carousel::all();
        logger('Carousel items:', ['items' => $carouselItems]); // Log les items pour vérifier
        return view('dashboard', compact('carouselItems'));
    }

}