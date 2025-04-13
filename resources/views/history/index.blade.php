<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800">📚 Historial de búsquedas</h2>
    </x-slot>

    <div class="py-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">🕒 Últimas búsquedas realizadas</h3>

            @if ($histories->isEmpty())
                <div class="text-center py-10 text-gray-400">
                    <svg class="w-12 h-12 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-sm">Aún no hay búsquedas guardadas.</p>
                </div>
            @else
                <ul class="divide-y divide-gray-200">
                    @foreach ($histories as $history)
                        <li class="flex items-center justify-between py-3">
                            <div>
                                <p class="text-gray-800 font-medium">{{ $history->city }}</p>
                                <p class="text-xs text-gray-500">{{ $history->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</x-app-layout>
