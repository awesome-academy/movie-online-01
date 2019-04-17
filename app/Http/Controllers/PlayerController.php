<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Film;

class PlayerController extends Controller
{
    public function show($id)
    {
    	$details = Film::findOrFail($id);
    	
    	return view('client.player', compact('details'));
    }
}
