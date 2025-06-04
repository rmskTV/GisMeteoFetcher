<?php

namespace App\Console\Commands;

use App\Models\CurrentWeatherData;
use App\Services\GismeteoService;
use Illuminate\Console\Command;

class FetchCurrentWeatherData extends Command
{
    protected $signature = 'weather:fetchCurrent';

    protected $description = 'Fetch weather data from Gismeteo API and store it in database';

    public function handle(): void
    {
        $latitude = 56.156; // Ваши координаты
        $longitude = 101.595; // Ваши координаты

        $service = new GismeteoService;
        $data = $service->getCurrentWeatherData($latitude, $longitude);

        if (! $data || ! isset($data['data'])) {
            $this->error('Failed to fetch weather data');

            return;
        }

        $weatherData = $data['data'];

        CurrentWeatherData::create([
            'city_name' => $weatherData['city']['name'],
            'city_name_p' => $weatherData['city']['nameP'],
            'latitude' => $weatherData['city']['latitude'],
            'longitude' => $weatherData['city']['longitude'],
            'description' => $weatherData['description'],
            'icon_emoji' => $weatherData['icon']['emoji'],
            'icon_weather' => $weatherData['icon']['icon-weather'],
            'air_temp_c' => $weatherData['temperature']['air']['C'],
            'comfort_temp_c' => $weatherData['temperature']['comfort']['C'],
            'water_temp_c' => $weatherData['temperature']['water']['C'] ?? null,
            'humidity_percent' => $weatherData['humidity']['percent'],
            'dew_point_c' => $weatherData['humidity']['dew_point']['C'],
            'precipitation_amount' => $weatherData['precipitation']['amount'],
            'precipitation_intensity' => $weatherData['precipitation']['intensity'],
            'precipitation_type' => $weatherData['precipitation']['type'],
            'precipitation_type_ext' => $weatherData['precipitation']['type_ext'],
            'precipitation_duration' => $weatherData['precipitation']['duration'],
            'pressure_mm_hg' => $weatherData['pressure']['mm_hg_atm'],
            'wind_direction_degree' => $weatherData['wind']['direction']['degree'],
            'wind_direction_scale_8' => $weatherData['wind']['direction']['scale_8'],
            'wind_speed_m_s' => $weatherData['wind']['speed']['m_s'],
            'wind_gust_speed_m_s' => $weatherData['wind']['gust_speed']['m_s'] ?? null,
            'wind_alternate_direction' => $weatherData['wind']['alternate_direction'],
            'cloudiness_percent' => $weatherData['cloudiness']['percent'],
            'cloudiness_scale_3' => $weatherData['cloudiness']['scale_3'],
            'moon_phase' => data_get($weatherData, 'astronomy.moon.phase'),
            'moon_percent_illuminated' => data_get($weatherData, 'astronomy.moon.percent_illuminated'),
            'sunrise' => data_get($weatherData, 'astronomy.sun.sunrise'),
            'sunset' => data_get($weatherData, 'astronomy.sun.sunset'),
            'storm_prediction' => $weatherData['storm']['prediction'],
            'storm_cape' => $weatherData['storm']['cape'],
            'utc_time' => $weatherData['date']['UTC'],
            'local_time' => $weatherData['date']['local'],
            'unix_time' => $weatherData['date']['unix'],
            'time_zone_offset' => $weatherData['date']['timeZoneOffset'],
        ]);

        //$this->info('Weather data successfully fetched and stored');
    }
}
