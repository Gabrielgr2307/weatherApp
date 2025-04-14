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

use Illuminate\Support\Facades\Route;
use Modules\Country\Http\Controllers\CountryController;

// Route::prefix('country')->group(function() {
//     Route::get('/', 'CountryController@index');
// });


// Route::prefix('country')->name('country.')->group(function () {
//     Route::get('selectCountry', ['CountryControllerselectCountry','as','selectCountry']);
//     Route::get('selectCitys/{id}', ['CountryControllerselectCitys','as','selectCitys']);
// });

Route::prefix('country')->name('country.')->group(function () {
    Route::get('selectCountry', [CountryController::class, 'selectCountry'])->name('selectCountry');
    Route::get('selectCitys/{id}', [CountryController::class, 'selectCitys'])->name('selectCitys');
});
