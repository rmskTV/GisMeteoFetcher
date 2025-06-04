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

        $weatherArray = $latestWeather->toArray();

        $html = '<!DOCTYPE html>
    <html>
    <head>
        <title>Latest Weather Data</title>
        <style>
            body { font-family: Arial, sans-serif; margin: 20px; }
            .weather-item { margin-bottom: 10px; }
            .weather-key { font-weight: bold; margin-right: 10px; }
            .weather-value { color: #333; }
            .temperature { color: #e74c3c; }
        </style>
    </head>
    <body>
        <h1>Latest Weather Data</h1>';

        foreach ($weatherArray as $key => $value) {
            if (in_array($key, ['created_at', 'updated_at', 'id'])) {
                continue;
            }

            // Форматируем температурные поля
            if (str_ends_with($key, '_temp_c') && is_numeric($value)) {
                $formattedValue = round($value, 1);
                $formattedValue = ($formattedValue > 0) ? '+'.$formattedValue : $formattedValue;
                $displayValue = $formattedValue.'°C';
                $tempClass = 'temperature';
            } else {
                $displayValue = is_array($value) ? json_encode($value) : $value;
                $displayValue = $displayValue ?? 'N/A';
                $tempClass = '';
            }

            $html .= sprintf(
                '<div class="weather-item">
                <span class="weather-key">%s:</span>
                <span class="weather-value %s">%s</span>
            </div>',
                ucfirst(str_replace('_', ' ', $key)),
                $tempClass,
                htmlspecialchars($displayValue)
            );
        }

        $html .= '</body></html>';

        return response($html);
    }
}
