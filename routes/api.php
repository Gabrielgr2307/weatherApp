<?php

use App\Http\Controllers\FavoriteCityController;
use App\Http\Controllers\SearchHistoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WeatherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::name('user.')->prefix('user')->group(function() {
    Route::POST('register', [UserController::class, 'register'])->name('register');
    Route::POST('login', [UserController::class, 'login'])->name('login');
    Route::GET('home', [UserController::class, 'home'])->middleware('auth:sanctum');;
});


Route::name('weather.')->prefix('weather')->middleware('auth:sanctum')->group(function () {
    Route::get('weatherclimate', [WeatherController::class, 'show']);
});

Route::name('favorites.')->prefix('favorites')->middleware('auth:sanctum')->group(function () {
    Route::post('toggle', [FavoriteCityController::class, 'toggleFavorite']);
    Route::get('favorites', [FavoriteCityController::class, 'listFavorites']);

});

Route::name('history.')->prefix('history')->middleware('auth:sanctum')->group(function () {
    Route::post('history', [SearchHistoryController::class, 'index']);
});
