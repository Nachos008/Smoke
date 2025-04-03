<?php

namespace App\Http\Controllers;

use App\Models\Games;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = \App\Models\Games::all();
        return view('store', compact('games'));
    }

    public function getGamePreview($id)
    {
        $game = Games::findOrFail($id);
        
        return response()->json([
            'title' => $game->title,
            'cover_image' => $game->cover_image,
            'description' => $game->description,
            'publisher' => $game->publisher,
            'developer' => $game->developer
        ]);
    }
}
