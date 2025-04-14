<?php

namespace Modules\History\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ApiSearchHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function historySearth(Request $request)
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
