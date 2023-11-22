<?php

use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(WeatherController::class)->prefix('weather')->as('weather.')->group(function () {
    Route::get('home', 'home')->name('weather.home');
    Route::get('api/load-weather-environment', 'loadWeatherEnvironment');
    Route::post('api/save-weather', 'saveWeather');
});
