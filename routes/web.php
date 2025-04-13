<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavoriteCityController;
use App\Http\Controllers\UserHistoryViewController;
use App\Http\Controllers\WeatherController;
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
    return view('welcome');
});


Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('history')->name('history.')->group(function () {
        Route::get('index', [UserHistoryViewController::class, 'index'])->name('index');
    });

    Route::prefix('country')->name('country.')->group(function () {
        Route::get('selectCountry', [CountryController::class, 'selectCountry'])->name('selectCountry');
        Route::get('selectCitys/{id}', [CountryController::class, 'selectCitys'])->name('selectCitys');
    });

    Route::prefix('weatherBlade')->name('weatherBlade.')->middleware(['auth', 'throttle:10,1'])->group(function () {
        Route::post('weatherclimate', [WeatherController::class, 'showBlade']);
    });

    Route::prefix('favoritesBlade')->name('favoritesBlade.')->middleware(['auth', 'throttle:20,1'])->group(function () {
        Route::get('index', [FavoriteCityController::class, 'index'])->name('index');
        Route::post('toggle', [FavoriteCityController::class, 'toggleFavorite'])->name('toggle');
    });

});

require __DIR__.'/auth.php';
