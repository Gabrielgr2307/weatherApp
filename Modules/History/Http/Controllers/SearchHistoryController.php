<?php

namespace Modules\History\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SearchHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $histories = $user->searchHistories()
        ->latest()
        ->take(10)
        ->get();
        $favorites = $user->favoriteCities()->get();


        return view('history.index', compact('histories'));
    }
}
