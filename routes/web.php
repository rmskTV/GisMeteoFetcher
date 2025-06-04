<?php

use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// JSON endpoint
Route::get('/weatherService/latest/json', [WeatherController::class, 'latestJson']);

// HTML endpoint
Route::get('/weatherService/latest', [WeatherController::class, 'latestHtml']);
