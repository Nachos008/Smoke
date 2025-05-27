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
            $games = \App\Models\Games::where('title', 'like', '%' . $search . '%')->get();
        } else {
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

    public function show($id)
    {
        $selectedGame = Games::findOrFail($id);
        $games = Games::all(); 

        $selectedGame->tagsArray;
        $selectedGame->criticReviews;
        $selectedGame->gameImages;
        $selectedGame->mainTrailerUrl;
        $selectedGame->secondaryTrailerUrl;

        return view('game', compact('selectedGame', 'games'));
    }
}
