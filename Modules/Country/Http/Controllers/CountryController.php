<?php

namespace Modules\Country\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Nnjeim\World\Models\Country;
use Nnjeim\World\Models\State;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
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
