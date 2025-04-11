<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchHistoryController extends Controller
{

    public function index(Request $request)
    {
        $histories = $request->user()
            ->searchHistories()
            ->latest()
            ->take(10)
            ->get();

        return response()->json([
            'message' => 'Últimas ciudades consultadas',
            'data' => $histories,
        ]);
    }
}
