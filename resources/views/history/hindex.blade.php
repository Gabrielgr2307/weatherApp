<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Búsquedas y Favoritos') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto">
        <div class="mb-6">
            <h3 class="text-lg font-bold mb-2">🕒 Historial reciente</h3>
            @if ($histories->isEmpty())
                <p class="text-gray-600">No has realizado búsquedas aún.</p>
            @else
                <ul class="list-disc pl-5 text-sm text-gray-700">
                    @foreach ($histories as $history)
                        <li>{{ $history->city }} <span class="text-gray-400 text-xs">({{ $history->created_at->format('d/m/Y H:i') }})</span></li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div>
            <h3 class="text-lg font-bold mb-2">⭐ Ciudades favoritas</h3>
            @if ($favorites->isEmpty())
                <p class="text-gray-600">No has marcado ciudades como favoritas.</p>
            @else
                <ul class="list-disc pl-5 text-sm text-gray-700">
                    @foreach ($favorites as $favorite)
                        <li>{{ $favorite->city }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</x-app-layout>
