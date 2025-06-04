<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrentWeatherData extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_name',
        'city_name_p',
        'latitude',
        'longitude',
        'description',
        'icon_emoji',
        'icon_weather',
        'air_temp_c',
        'comfort_temp_c',
        'water_temp_c',
        'humidity_percent',
        'dew_point_c',
        'precipitation_amount',
        'precipitation_intensity',
        'precipitation_type',
        'precipitation_type_ext',
        'precipitation_duration',
        'pressure_mm_hg',
        'wind_direction_degree',
        'wind_direction_scale_8',
        'wind_speed_m_s',
        'wind_gust_speed_m_s',
        'wind_alternate_direction',
        'cloudiness_percent',
        'cloudiness_scale_3',
        'moon_phase',
        'moon_percent_illuminated',
        'sunrise',
        'sunset',
        'storm_prediction',
        'storm_cape',
        'utc_time',
        'local_time',
        'unix_time',
        'time_zone_offset',
    ];

    protected $casts = [
        'utc_time' => 'datetime',
        'local_time' => 'datetime',
        'wind_alternate_direction' => 'boolean',
        'storm_prediction' => 'boolean',
    ];
}
