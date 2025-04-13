<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Nnjeim\World\Models\Country;

class WeatherService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.weatherapi.key', 'dc155292e28e41cc869203736251104');
        $this->baseUrl = 'https://api.weatherapi.com/v1';
    }

    public function getCurrentWeather($city, $country = null)
    {
        $location = $city;

        if ($country) {
            $countryName = Cache::remember("country_name_{$country}", 3600, function () use ($country) {
                return optional(Country::select('name')->find($country))->name;
            });

            if ($countryName) {
                $location .= ", {$countryName}";
            }
        }

        $cacheKey = "weather_" . md5($location);

        return Cache::remember($cacheKey, 300, function () use ($location) {
            $response = Http::get("{$this->baseUrl}/current.json", [
                'key' => $this->apiKey,
                'q'   => $location,
                'lang'=> 'es',
            ]);

            return $response->successful() ? $response->json() : null;
        });
    }
}
