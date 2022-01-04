<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/song', [App\Http\Controllers\HomeController::class, 'saveSong'])->name('song.save');

Route::get('/song', [App\Http\Controllers\HomeController::class, 'allSongs'])->name('song.all');

Route::get('/mysongs', [App\Http\Controllers\HomeController::class, 'mySongs'])->name('song.my');

Route::delete('/deletesong/{id}', [App\Http\Controllers\HomeController::class, 'deleteSong'])->name('song.delete');

Route::get('/myfavoritesongs', [App\Http\Controllers\HomeController::class, 'myFavoriteSongs'])->name('song.favorites');

Route::post('/myfavoritesongs', [App\Http\Controllers\HomeController::class, 'addFavoriteSongs'])->name('song.addfavorite');

Route::get('/isfavoritesong/{song_id}', [App\Http\Controllers\HomeController::class, 'isFavoriteSong'])->name('song.isfavorite');

Route::get('/dropfavoritesong/{song_id}', [App\Http\Controllers\HomeController::class, 'dropFavoriteSong'])->name('song.dropfavorite');