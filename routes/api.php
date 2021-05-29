<?php

use App\Http\Controllers\FlightDataController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'airports'], function () {
    Route::get('search/{query}', [FlightDataController::class, 'airportSearch'])->name('cities.search');
});

Route::group(['prefix' => 'flights'], function () {
    Route::post('search', [FlightDataController::class, 'offerSearch'])->name('flights.search');
});
