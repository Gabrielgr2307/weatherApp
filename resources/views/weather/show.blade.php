<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800">
            Clima en {{ $weather['location']['name'] }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto" x-data="{ isFavorite: {{ $isFavorite ? 'true' : 'false' }} }">
        <div class="bg-white shadow-md p-6 rounded-lg">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-700">
                    {{ $weather['current']['condition']['text'] }} – {{ $weather['current']['temp_c'] }} °C
                </h3>
                <button @click="toggleFavorite('{{ $weather['location']['name'] }}')"
                    :class="isFavorite ? 'text-yellow-400 scale-125' : 'text-gray-400 hover:text-yellow-400'"
                    class="text-2xl transform transition duration-300 ease-in-out focus:outline-none"
                    title="Marcar como favorito">
                    <template x-if="isFavorite">
                        <span>★</span>
                    </template>
                    <template x-if="!isFavorite">
                        <span>☆</span>
                    </template>

                </button>



            </div>

            <div class="text-sm text-gray-600">
                <p><strong>Humedad:</strong> {{ $weather['current']['humidity'] }}%</p>
                <p><strong>Viento:</strong> {{ $weather['current']['wind_kph'] }} km/h</p>
                <p><strong>Hora local:</strong> {{ $weather['location']['localtime'] }}</p>
            </div>
        </div>

        {{-- <script>
            function toggleFavorite(city) {
                fetch("{{ route('favorites.toggle') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            city
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.message === 'Agregado') {
                            document.querySelector('[x-data]').__x.$data.isFavorite = true;
                        } else if (data.message === 'Eliminado') {
                            document.querySelector('[x-data]').__x.$data.isFavorite = false;
                        }
                    });
            }

            window.toggleFavorite = toggleFavorite;
        </script> --}}
    </div>
</x-app-layout>
