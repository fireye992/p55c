<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SearchModel;

class SearchResultController extends Controller
{
    public function show($id)
    {
        $result = SearchModel::findOrFail($id);
        return view('search-results', compact('result'));
    }
}
