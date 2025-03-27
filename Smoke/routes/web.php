<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\GameController;

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('index'); // Show home page to logged-in users
})->name('home');

Route::get('/library', function () {
    if (!Auth::check()) {
        return redirect('login'); // Redirect guests to login page
    }
    return view('library'); // Show home page to logged-in users
})->name('library'); 

Route::get('/qa', function () {
    if (!Auth::check()) {
        return redirect('login'); // Redirect guests to login page
    }
    return view('q&a');; // Show home page to logged-in users
})->name('qa');
Route::get('/store', [GameController::class, 'index'])->name('store')->middleware('auth');
Route::get('/profile', function () {
    return view('profile');
})->name('profile');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/register', [UserController::class, 'showRegistrationForm']);
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::get('/login', [UserController::class, 'showLoginForm']);
Route::post('/login', [UserController::class, 'login'])->name('login');
