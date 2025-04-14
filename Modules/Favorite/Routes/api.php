<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiFavoriteCityController;
use Modules\Favorite\Http\Controllers\ApiFavoriteController;

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


Route::prefix('favorites')->name('favorites.')->middleware(['auth:sanctum','check-token-expiration','throttle:20,1'])->group(function () {
    Route::post('toggle', [ApiFavoriteController::class, 'toggleFavorite'])->name('toggle');
    Route::post('add', [ApiFavoriteController::class, 'addFavorite'])->name('add');
    Route::post('remove', [ApiFavoriteController::class, 'removeFavorite'])->name('remove');
    Route::post('isFavorite', [ApiFavoriteController::class, 'isFavorite'])->name('isFavorite');
    Route::get('listFavoritesApi', [ApiFavoriteController::class, 'listFavoritesApi'])->name('listFavoritesApi');
});
