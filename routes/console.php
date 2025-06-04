<?php

use App\Console\Commands\FetchCurrentWeatherData;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('weather:fetchCurrent', function () {
    app(FetchCurrentWeatherData::class)->handle();
})->purpose('Fetch weather data from Gismeteo API');
