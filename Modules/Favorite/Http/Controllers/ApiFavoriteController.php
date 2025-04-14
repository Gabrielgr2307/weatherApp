<?php

namespace Modules\Favorite\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ApiFavoriteController extends Controller
{


    public function toggleFavorite(Request $request)
    {
        $request->validate([
            'city' => 'required|string|max:255'
        ]);

        $city = $request->input('city');

        $favorite = $request->user()->favoriteCities()->where('city', $city)->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['message' => 'Eliminado']);
        }

        $request->user()->favoriteCities()->create(['city' => $city]);
        return response()->json(['message' => 'Agregado']);
    }

    public function addFavorite(Request $request)
    {
        $request->validate([
            'city' => 'required|string|max:255'
        ]);

        $user = $request->user();
        $exists = $user->favoriteCities()->where('city', $request->city)->exists();

        if ($exists) {
            return response()->json(['message' => 'Ya está en favoritos'], 200);
        }

        $user->favoriteCities()->create([ 'city' => $request->city ]);

        return response()->json(['message' => 'Ciudad agregada a favoritos'], 201);
    }

    public function removeFavorite(Request $request)
    {
        $request->validate([
            'city' => 'required|string|max:255'
        ]);

        $user = $request->user();
        $favorite = $user->favoriteCities()->where('city', $request->city)->first();

        if (!$favorite) {
            return response()->json(['message' => 'La ciudad no está en favoritos'], 404);
        }

        $favorite->delete();
        return response()->json(['message' => 'Ciudad eliminada de favoritos'], 200);
    }

    public function isFavorite(Request $request)
    {
        $request->validate([
            'city' => 'required|string|max:255'
        ]);

        $city = $request->input('city');
        $exists = $request->user()->favoriteCities()->where('city', $city)->exists();

        return response()->json(['isFavorite' => $exists]);
    }

    public function listFavoritesApi(Request $request)
    {
        $user = $request->user();

        $favorites = $user->favoriteCities()
            ->latest()
            ->take(10)
            ->get(['id', 'city', 'created_at']);

        return response()->json($favorites, 200);
    }

}
