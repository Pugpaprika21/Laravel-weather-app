<?php

namespace App\Http\Controllers;

use App\Models\Weather;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function home()
    {
        return view('weather-home');
    }

    public function loadWeatherEnvironment(Request $request)
    {
        return response()->json([
            'data' => [
                'api' => env('API_KEY'),
                'active' => true,
            ]
        ]);
    }

    public function saveWeather(Request $request)
    {
        $body = $request->only(['data']);

        $weather = new Weather();
        
        $weather->lon = $body['coord']['lon'];
        $weather->lat = $body['coord']['lat'];
        $weather->weather_id = $body['weather'][0]['id'];
        $weather->weather_main = $body['weather'][0]['main'];
        $weather->weather_description = $body['weather'][0]['description'];
        $weather->weather_icon = $body['weather'][0]['icon'];
        $weather->base = $body['base'];
        $weather->temp = $body['main']['temp'];
        $weather->feels_like = $body['main']['feels_like'];
        $weather->temp_min = $body['main']['temp_min'];
        $weather->temp_max = $body['main']['temp_max'];
        $weather->pressure = $body['main']['pressure'];
        $weather->humidity = $body['main']['humidity'];
        $weather->sea_level = $body['main']['sea_level'];
        $weather->grnd_level = $body['main']['grnd_level'];
        $weather->visibility = $body['visibility'];
        $weather->wind_speed = $body['wind']['speed'];
        $weather->wind_deg = $body['wind']['deg'];
        $weather->wind_gust = $body['wind']['gust'];
        $weather->clouds_all = $body['clouds']['all'];
        $weather->dt = $body['dt'];
        $weather->sys_type = $body['sys']['type'];
        $weather->sys_id = $body['sys']['id'];
        $weather->sys_country = $body['sys']['country'];
        $weather->sys_sunrise = $body['sys']['sunrise'];
        $weather->sys_sunset = $body['sys']['sunset'];
        $weather->timezone = $body['timezone'];
        $weather->city_id = $body['id'];
        $weather->city_name = $body['name'];
        $weather->cod = $body['cod'];
        $weather->save();

        return response()->json([
            'base' => $body['data']['base']
        ]);
    }
}
