<?php

use Illuminate\Support\Facades\Route;

// Route::post("/login", "Auth\LoginController@login");
// Route::post("/logout", "Auth\LoginController@logout");
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
