<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = 'dc155292e28e41cc869203736251104';
        $this->baseUrl = 'https://api.weatherapi.com/v1';
    }

    public function getCurrentWeather($city)
    {
        $response = Http::get("{$this->baseUrl}/current.json", [
            'key' => $this->apiKey,
            'q' => $city,
            'lang' => 'es',
        ]);


        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
}
