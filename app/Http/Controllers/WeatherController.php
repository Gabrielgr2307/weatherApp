<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WeatherService;

class WeatherController extends Controller
{
    protected $weather;

    public function __construct(WeatherService $weather)
    {
        $this->weather = $weather;
    }

    public function show(Request $request)
    {
        $city = $request->city;
        $country = $request->country;
        return $this->getWeatherData($request, $city, $country);
    }

    public function showBlade(Request $request)
    {
        $city = $request->city;
        $country = $request->country;
        if ($city == "Distrito Capital") {
            $city = "Caracas";
        }
        return $this->getWeatherData($request, $city, $country);
    }

    private function getWeatherData(Request $request, $city, $country)
    {
        $data = $this->weather->getCurrentWeather($city, $country);

        if (!$data) {
            return response()->json(['error' => 'No se pudo obtener el clima'], 500);
        }

        $request->user()->searchHistories()->create([
            'city' => $city,
            'country' => $country
        ]);

        return response()->json([
            'resul' => [
                'ciudad' => $data['location']['name'],
                'pais' => $data['location']['country'],
                'hora_local' => $data['location']['localtime'],
                'temperatura' => $data['current']['temp_c'] . ' °C',
                'estado' => $data['current']['condition']['text'],
                'icono' => $data['current']['condition']['icon'],
                'viento_kph' => $data['current']['wind_kph'] . ' km/h',
                'humedad' => $data['current']['humidity'] . '%',
                'msg' => 'Búsqueda exitosa',
                'isFavorite' => $request->user()->favoriteCities()
                                    ->where('city', $data['location']['name'])
                                    ->exists()
            ]
        ]);
    }
}
