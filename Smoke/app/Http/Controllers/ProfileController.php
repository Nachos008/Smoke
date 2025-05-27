<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $games = $user->games; // Get user's games from the relationship
        
        return view('profile', compact('user', 'games'));
    }
}
