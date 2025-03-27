<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = \App\Models\Games::all();
        return view('store', compact('games'));

        
    }

}
