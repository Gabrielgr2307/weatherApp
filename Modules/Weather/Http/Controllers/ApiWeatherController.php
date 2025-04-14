<?php

namespace Modules\Weather\Http\Controllers;

use App\Services\WeatherService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ApiWeatherController extends Controller
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


}
