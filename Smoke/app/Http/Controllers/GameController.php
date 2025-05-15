<?php

namespace App\Http\Controllers;

use App\Models\Games;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        
        if ($search) {
            // Search for games that match the query by title only
            $games = \App\Models\Games::where('title', 'like', '%' . $search . '%')->get();
        } else {
            // If no search query, get all games
            $games = \App\Models\Games::all();
        }
        
        return view('store', compact('games', 'search'));
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
