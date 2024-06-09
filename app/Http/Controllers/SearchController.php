<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SearchModel;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');


        $results = SearchModel::where('content', 'LIKE', "%$query%")->get();

        // Nettoyage du contenu
        foreach ($results as $result) {
            $result->content = strip_tags($result->content);
        }

 

        return view('search-results', compact('results'));
    }
}
