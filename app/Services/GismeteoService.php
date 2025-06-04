<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GismeteoService
{
    protected $apiToken;

    protected $baseUrl = 'https://api.gismeteo.net/v3/weather';

    public function __construct()
    {
        $this->apiToken = env('GISMETEO_API_TOKEN');
    }

    public function getCurrentWeatherData(float $latitude, float $longitude)
    {
        try {
            $response = Http::withHeaders([
                'X-Gismeteo-Token' => $this->apiToken,
            ])->get($this->baseUrl.'/current/', [
                'latitude' => $latitude,
                'longitude' => $longitude,
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('Gismeteo API error', [
                'status' => $response->status(),
                'response' => $response->body(),
            ]);

            return null;
        } catch (\Exception $e) {
            Log::error('Gismeteo API exception', [
                'error' => $e->getMessage(),
            ]);

            return null;
        }
    }
}
