<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Film;

class SearchController extends Controller
{
    public function searchFullText(Request $request)
    {
    	if ($request->q != '') {
          $data = Film::FullTextSearch('title_en', $request->q)->get();

          return response()->json($data);
      }
    }
}
