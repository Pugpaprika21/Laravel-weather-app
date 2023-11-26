<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeatherRequest;
use App\Http\Resources\WeatherResource;
use App\Models\Weather;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function home()
    {
        return view('weather-home');
    }

    public function loadWeatherEnvironment(Request $request): JsonResponse
    {
        // 31d3e799f96f9bd02f7d6782a0a484d9
        return response()->json([
            'data' => [
                'api' => '937feb80d0e6d400030171095c97a18a',
                'active' => true,
            ]
        ]);
    }

    public function saveWeather(Request $request): JsonResponse
    {
        $body = $request->only(['data']);

        $weather = new Weather();

        $weather->lon = $body['data']['coord']['lon'];
        $weather->lat = $body['data']['coord']['lat'];
        $weather->weather_id = $body['data']['weather'][0]['id'];
        $weather->weather_main = $body['data']['weather'][0]['main'];
        $weather->weather_description = $body['data']['weather'][0]['description'];
        $weather->weather_icon = $body['data']['weather'][0]['icon'];
        $weather->base = $body['data']['base'];
        $weather->temp = $body['data']['main']['temp'];
        $weather->feels_like = $body['data']['main']['feels_like'];
        $weather->temp_min = $body['data']['main']['temp_min'];
        $weather->temp_max = $body['data']['main']['temp_max'];
        $weather->pressure = $body['data']['main']['pressure'];
        $weather->humidity = $body['data']['main']['humidity'];
        $weather->sea_level = $body['data']['main']['sea_level'];
        $weather->grnd_level = $body['data']['main']['grnd_level'];
        $weather->visibility = $body['data']['visibility'];
        $weather->wind_speed = $body['data']['wind']['speed'];
        $weather->wind_deg = $body['data']['wind']['deg'];
        $weather->wind_gust = $body['data']['wind']['gust'];
        $weather->clouds_all = $body['data']['clouds']['all'];
        $weather->dt = $body['data']['dt'];
        $weather->sys_type = $body['data']['sys']['type'];
        $weather->sys_id = $body['data']['sys']['id'];
        $weather->sys_country = $body['data']['sys']['country'];
        $weather->sys_sunrise = $body['data']['sys']['sunrise'];
        $weather->sys_sunset = $body['data']['sys']['sunset'];
        $weather->timezone = $body['data']['timezone'];
        $weather->city_id = $body['data']['id'];
        $weather->city_name = $body['data']['name'];
        $weather->cod = $body['data']['cod'];
        $weather->save();

        if ($weather->id) {
            return response()->json(['Data' => ['Id' => $weather->id, 'Message' => 'save weather data successfully..']]);
        }
        return response()->json(['Data' => ['Id' => null, 'Message' => 'error']]);
    }

    public function showWeathers(?WeatherRequest $request): JsonResponse
    {
        $perPage = 5;
        $weather = new Weather();
    
        $rsqWeathers = $weather::select('lon', 'lat', 'weather_main', 'weather_description', 'sys_country', 'city_name')
            ->orderBy('id')
            ->paginate($perPage);
    
        if ($rsqWeathers->count() > 0) {
            return response()->json(new WeatherResource($rsqWeathers), 200);
        }
        return response()->json(['Data' => null], 204);
    }
}
