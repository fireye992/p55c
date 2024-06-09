<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carousel;

class DashboardController extends Controller
{
    public function index()
    {
        //pour carrousel si jamais
        $carouselItems = Carousel::all();
        return view('dashboard', compact('carouselItems'));
    }


}