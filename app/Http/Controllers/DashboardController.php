<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Umpirsky\CountryList\CountryList;
use App\Models\Country;
use Nnjeim\World\Models\Country as ModelsCountry;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        $countries  = ModelsCountry::all();

        return view('dashboard');
    }

}
