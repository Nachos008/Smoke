<?php

use App\Http\Controllers\AuthController;

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (!Auth::attempt()) {
        return redirect('/login'); // Redirect guests to login page
    }
    return view('index'); // Show home page to logged-in users
})->name('home');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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
Route::get('/register', function () {
    return view('auth.register');
});

Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
