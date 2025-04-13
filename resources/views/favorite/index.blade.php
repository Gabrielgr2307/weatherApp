<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800">⭐ Ciudades favoritas</h2>
    </x-slot>

    <div class="py-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-md p-6" x-data="favoritosApp()">
            <h3 class="text-lg font-semibold text-gray-700 mb-6">⭐ Tus ciudades favoritas</h3>

            <template x-if="favoritos.length > 0">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    <template x-for="(fav, index) in favoritos" :key="fav.id">
                        <div class="bg-gradient-to-br from-blue-100 to-white border border-blue-200 rounded-xl p-5 shadow relative">
                            <h4 class="text-lg font-semibold text-gray-800 mb-2" x-text="fav.city"></h4>
                            <p class="text-sm text-gray-500">Favorita guardada</p>
                            <button @click="removeFavorite(fav.city, index)"
                                    class="absolute top-2 right-2 text-red-500 hover:text-red-600 transition text-sm font-medium">
                                ✖
                            </button>
                        </div>
                    </template>
                </div>
            </template>

            <template x-if="favoritos.length === 0">
                <div class="text-center py-10 text-gray-400">
                    <svg class="w-12 h-12 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-sm">Aún no tienes ciudades marcadas como favoritas.</p>
                </div>
            </template>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>
        function favoritosApp() {
            return {
                favoritos: @js($favorites),
                removeFavorite(city, index) {
                    fetch("{{ route('favoritesBlade.toggle') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ city })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.message === "Eliminado") {
                            this.favoritos.splice(index, 1);
                            swal("Eliminado", city + " ha sido quitado de tus favoritos", "info");
                        }
                    });
                }
            }
        }
    </script>
</x-app-layout>
