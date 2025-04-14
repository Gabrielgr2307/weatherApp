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
use Modules\Swagger\Http\Controllers\SwaggerController;


Route::prefix('documents')->name('documents.')->group(function () {
    Route::get('index', [SwaggerController::class, 'index'])->name('index');
    Route::get('/api/documentation.json', '\L5Swagger\Http\Controllers\SwaggerController@api');
});


