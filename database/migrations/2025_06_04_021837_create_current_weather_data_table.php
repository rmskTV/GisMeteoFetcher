<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('current_weather_data', function (Blueprint $table) {
            $table->id();

            // Основные данные
            $table->string('city_name');
            $table->string('city_name_p');
            $table->decimal('latitude', 10, 6);
            $table->decimal('longitude', 10, 6);
            $table->string('description');
            $table->string('icon_emoji');
            $table->string('icon_weather');

            // Температура
            $table->decimal('air_temp_c', 5, 2);
            $table->decimal('comfort_temp_c', 5, 2);
            $table->decimal('water_temp_c', 5, 2)->nullable();

            // Влажность
            $table->integer('humidity_percent');
            $table->decimal('dew_point_c', 5, 2);

            // Осадки
            $table->decimal('precipitation_amount', 5, 2);
            $table->integer('precipitation_intensity');
            $table->integer('precipitation_type');
            $table->integer('precipitation_type_ext');
            $table->integer('precipitation_duration');

            // Давление
            $table->integer('pressure_mm_hg');

            // Ветер
            $table->integer('wind_direction_degree');
            $table->integer('wind_direction_scale_8');
            $table->decimal('wind_speed_m_s', 5, 2);
            $table->decimal('wind_gust_speed_m_s', 5, 2)->nullable();
            $table->boolean('wind_alternate_direction');

            // Облачность
            $table->integer('cloudiness_percent');
            $table->integer('cloudiness_scale_3');

            // Астрономия
            $table->string('moon_phase')->nullable();
            $table->decimal('moon_percent_illuminated', 5, 2)->nullable();
            $table->string('sunrise')->nullable();
            $table->string('sunset')->nullable();

            // Шторм
            $table->boolean('storm_prediction');
            $table->decimal('storm_cape', 5, 2);

            // Даты
            $table->timestamp('utc_time');
            $table->timestamp('local_time');
            $table->bigInteger('unix_time');
            $table->integer('time_zone_offset');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('current_weather_data');
    }
};
