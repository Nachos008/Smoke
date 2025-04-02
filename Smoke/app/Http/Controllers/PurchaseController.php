<?php

namespace App\Http\Controllers;

use App\Models\Games;
use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function buyGame($id)
    {
        $user = Auth::user();
    $game = Games::findOrFail($id);
    
    // Check user model type and handle accordingly
    if (get_class($user) === 'App\Models\User') {
        // Use User model approach
        // Check if the game_user table has this relationship
        if (DB::table('user_games')->where('user_id', $user->id)->where('game_id', $id)->exists()) {
            return redirect()->back()->with('error', 'You already own this game!');
        }
        
        // Create the relationship manually
        DB::table('user_games')->insert([
            'user_id' => $user->id,
            'game_id' => $id,
            'purchased_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    } else {
        // Same approach for Users model
        if (DB::table('user_games')->where('user_id', $user->id)->where('game_id', $id)->exists()) {
            return redirect()->back()->with('error', 'You already own this game!');
        }
        
        DB::table('user_games')->insert([
            'user_id' => $user->id,
            'game_id' => $id,
            'purchased_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
    
    return redirect()->route('library')->with('success', 'Game purchased successfully!');
    }
    
    public function userLibrary(Request $request)
    {
        $user = Auth::user();
        $games = $user->games;
        
        $selectedGame = null;
        if ($request->has('game')) {
            $selectedGame = $games->where('id', $request->game)->first();
        }
        
        return view('library', compact('games', 'selectedGame'));
    }

    
}
