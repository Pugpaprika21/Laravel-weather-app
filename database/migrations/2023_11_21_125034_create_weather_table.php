<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('weather', function (Blueprint $table) {
            $table->id();
            $table->float('lon');
            $table->float('lat');
            $table->integer('weather_id');
            $table->string('weather_main');
            $table->string('weather_description');
            $table->string('weather_icon');
            $table->string('base');
            $table->float('temp');
            $table->float('feels_like');
            $table->float('temp_min');
            $table->float('temp_max');
            $table->integer('pressure');
            $table->integer('humidity');
            $table->integer('sea_level');
            $table->integer('grnd_level');
            $table->integer('visibility');
            $table->float('wind_speed');
            $table->integer('wind_deg');
            $table->float('wind_gust');
            $table->integer('clouds_all');
            $table->integer('dt');
            $table->integer('sys_type');
            $table->integer('sys_id');
            $table->string('sys_country');
            $table->integer('sys_sunrise');
            $table->integer('sys_sunset');
            $table->integer('timezone');
            $table->integer('city_id');
            $table->string('city_name');
            $table->integer('cod');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weather_data');
    }
};
