<?php

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

use App\Http\Controllers\FavoriteCityController;
use Illuminate\Support\Facades\Route;



Route::prefix('favoritesBlade')->name('favoritesBlade.')->middleware(['auth', 'throttle:20,1'])->group(function () {
    Route::get('index', [FavoriteCityController::class, 'index'])->name('index');
    Route::post('toggle', [FavoriteCityController::class, 'toggleFavorite'])->name('toggle');
});
