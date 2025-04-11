<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserHistoryViewController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $histories = $user->searchHistories()
            ->latest()
            ->take(10)
            ->get();

        $favorites = $user->favoriteCities()->get();

        return view('history.index', compact('histories', 'favorites'));
    }
}
