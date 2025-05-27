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
    
    if (get_class($user) === 'App\Models\User') {
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
    } else {
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
            $gameId = $request->game;
            $selectedGame = $games->first(function($game) use ($gameId) {
                return ($game->game_id ?? $game->id) == $gameId;
            });
        }
        
        return view('library', compact('games', 'selectedGame'));
    }
    
    public function sellGame($id){
        $user = Auth::user();
        
        /*DB::table('user_games')->delete([
            'user_id' => $user->id,
            'game_id' => $id,
            'purchased_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);*/
        DB::table('user_games')
        ->where('user_id', $user->id)
        ->where('game_id', $id)
        ->delete();

        return redirect()->route('library')->with('success', 'Game sold successfully!');
    }
    
}
