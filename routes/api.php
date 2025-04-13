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

Route::prefix('user')->name('user.')->group(function () {
    Route::post('register', [UserController::class, 'register'])->name('register');
    Route::post('login', [UserController::class, 'login'])->name('login');
    Route::post('logout', [UserController::class, 'logout'])->middleware(['auth:sanctum', 'check-token-expiration']);
    Route::get('home', [UserController::class, 'home'])->middleware(['auth:sanctum', 'check-token-expiration']);
});

Route::name('weather.')->prefix('weather')->middleware(['auth:sanctum', 'check-token-expiration', 'throttle:10,1'])->group(function () {
    Route::post('weatherclimate', [WeatherController::class, 'show']);
});



Route::name('history.')->prefix('history')->middleware(['auth:sanctum', 'check-token-expiration', 'throttle:15,1'])->group(function () {
    Route::get('historySearth', [SearchHistoryController::class, 'historySearth']);
});


Route::prefix('favorites')->name('favorites.')->middleware(['auth:sanctum','check-token-expiration','throttle:20,1'])->group(function () {
    Route::post('toggle', [FavoriteCityController::class, 'toggleFavorite'])->name('toggle');
    Route::post('add', [FavoriteCityController::class, 'addFavorite'])->name('add');
    Route::post('remove', [FavoriteCityController::class, 'removeFavorite'])->name('remove');
    Route::post('isFavorite', [FavoriteCityController::class, 'isFavorite'])->name('isFavorite');
    Route::get('listFavoritesApi', [FavoriteCityController::class, 'listFavoritesApi'])->name('listFavoritesApi');
});
