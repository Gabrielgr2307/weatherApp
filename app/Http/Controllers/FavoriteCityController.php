<?php

namespace App\Http\Controllers;

use App\Models\FavoriteCity;
use Illuminate\Http\Request;

class FavoriteCityController extends Controller
{
    public function toggleFavorite(Request $request)
    {
        $request->validate([
            'city' => 'required|string|max:255'
        ]);

        $city = $request->input('city');

        $favorite = FavoriteCity::where('user_id', $request->user()->id)
            ->where('city', $city)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['message' => 'Ciudad removida de favoritos']);
        }

        $request->user()->favoriteCities()->create([
            'city' => $city
        ]);

        return response()->json(['message' => 'Ciudad marcada como favorita']);
    }

    public function listFavorites(Request $request)
    {
        $favorites = $request->user()->favoriteCities()->get();

        return response()->json([
            'message' => 'Ciudades favoritas',
            'data' => $favorites,
        ]);
    }
}
