<?php

use App\Http\Controllers\UserController;

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index'); // Show home page to logged-in users
})->name('home');

Route::get('/library', function () {
    return view('library');
})->name('library'); 

Route::get('/qa', function () {
    return view('q&a');
})->name('qa');
Route::get('/store', function () {
    return view('store');
})->name('store');
Route::get('/profile', function () {
    return view('profile');
})->name('profile');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/register', [UserController::class, 'showRegistrationForm']);
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::get('/login', [UserController::class, 'showLoginForm']);
Route::post('/login', [UserController::class, 'login'])->name('login');
