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
        $city = $request->query('city', 'Caracas');

        $data = $this->weather->getCurrentWeather($city);
        if (!$data) {
            return response()->json(['error' => 'No se pudo obtener el clima'], 500);
        }

        // Guardar historial
        $request->user()->searchHistories()->create([
            'city' => $city
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
            ]
        ]);
    }
}
