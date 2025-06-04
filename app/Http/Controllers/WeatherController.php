<?php

namespace App\Http\Controllers;

use App\Models\CurrentWeatherData;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    // Метод для возврата JSON
    public function latestJson(): \Illuminate\Http\JsonResponse
    {
        $latestWeather = CurrentWeatherData::latest()->first();

        if (!$latestWeather) {
            return response()->json(['message' => 'No weather data available'], 404);
        }

        return response()->json($latestWeather);
    }

    // Метод для возврата HTML
    public function latestHtml()
    {
        $latestWeather = CurrentWeatherData::latest()->first();

        if (!$latestWeather) {
            return response('<p>No weather data available</p>', 404);
        }

        // Преобразуем модель в массив
        $weatherArray = $latestWeather->toArray();

        $html = '<!DOCTYPE html>
        <html>
        <head>
            <title>Latest Weather Data</title>
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; }
                .weather-item { margin-bottom: 10px; }
                .weather-key { font-weight: bold; margin-right: 10px; }
            </style>
        </head>
        <body>
            <h1>Latest Weather Data</h1>';

        foreach ($weatherArray as $key => $value) {
            if (in_array($key, ['created_at', 'updated_at', 'id'])) {
                continue;
            }

            $displayValue = is_array($value) ? json_encode($value) : $value;
            $displayValue = $displayValue ?? 'N/A';

            $html .= sprintf(
                '<div class="weather-item">
                    <span class="weather-key">%s:</span>
                    <span class="weather-value">%s</span>
                </div>',
                ucfirst(str_replace('_', ' ', $key)),
                htmlspecialchars($displayValue)
            );
        }

        $html .= '</body></html>';

        return response($html);
    }
}
