<?php

namespace Tests\Unit;

use App\Services\WeatherService;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class WeatherServiceTest extends TestCase
{
    public function test_get_current_weather_returns_data()
    {
        Http::fake([
            '*' => Http::response([
                'location' => [
                    'name' => 'Caracas',
                    'country' => 'Venezuela',
                    'localtime' => '2025-04-13 12:00',
                ],
                'current' => [
                    'temp_c' => 28,
                    'humidity' => 80,
                    'wind_kph' => 5,
                    'condition' => [
                        'text' => 'Soleado',
                        'icon' => 'someicon.png'
                    ]
                ]
            ], 200)
        ]);

        $service = new WeatherService();
        $data = $service->getCurrentWeather('Caracas');

        $this->assertEquals('Caracas', $data['location']['name']);
    }
}
