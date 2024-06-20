<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function show($id)
    {
        $page = Page::findOrFail($id);
        return view('pages.show', compact('page'));
    }
}