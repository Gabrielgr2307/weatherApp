<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Nnjeim\World\Models\Country;
use Nnjeim\World\Models\State;

class CountryController extends Controller
{
    public function selectCountry()
    {
        $countries = Cache::remember('country_list', 3600, function () {
            return Country::select('id', 'name')->orderBy('name')->get();
        });

        return response()->json($countries);
    }

    public function selectCitys($country_id)
    {
        $cacheKey = "cities_country_{$country_id}";

        $cities = Cache::remember($cacheKey, 3600, function () use ($country_id) {
            return State::select('name')
                ->where('country_id', $country_id)
                ->orderBy('name')
                ->get();
        });

        return response()->json($cities);
    }
}
