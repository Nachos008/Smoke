<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
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
