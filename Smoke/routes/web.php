<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ProfileController;

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('index'); // Show home page to logged-in users
})->name('home');

Route::get('/library', [PurchaseController::class, 'userLibrary'])->name('library')->middleware('auth');

Route::get('/qa', function () {
    if (!Auth::check()) {
        return redirect('login'); // Redirect guests to login page
    }
    return view('q&a');; // Show home page to logged-in users
})->name('qa');
Route::get('/store', [GameController::class, 'index'])->name('store')->middleware('auth');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile')->middleware('auth');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/register', [UserController::class, 'showRegistrationForm']);
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::get('/login', [UserController::class, 'showLoginForm']);
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::post('/buy-game/{id}', [PurchaseController::class, 'buyGame'])->name('buy.game')->middleware('auth');
Route::post('/sell-game/{id}', [PurchaseController::class, 'sellGame'])->name('sell.game')->middleware('auth');

Route::get('/store/game/{id}', [GameController::class, 'show'])->name('store.game.show');

