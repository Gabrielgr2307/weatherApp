
<div class="bg-gradient-to-tr from-blue-100 to-white shadow-lg rounded-xl p-6">
    <div class="flex justify-between items-center mb-4">
        <div>
            <h3 class="text-2xl font-bold text-gray-800" x-text="weatherData.location.name"></h3>
            <p class="text-sm text-gray-600" x-text="'Hora local: ' + weatherData.location.localtime"></p>
        </div>
        <div class="text-4xl" :title="isFavorite ? 'Quitar de favoritos' : 'Agregar a favoritos'">
            <button @click="toggleFavorite(weatherData.location.name)"
                :class="isFavorite ? 'text-yellow-400 scale-110' : 'text-gray-400 hover:text-yellow-400'"
                class="transform transition duration-300 ease-in-out focus:outline-none">
                <template x-if="isFavorite">★</template>
                <template x-if="!isFavorite">☆</template>
            </button>
        </div>
    </div>

    <div class="flex items-center space-x-4 mb-4">
        <img :src="'https:' + weatherData.current.condition.icon" alt="Icono clima" class="w-16 h-16">
        <div>
            <p class="text-xl font-semibold text-gray-800" x-text="weatherData.current.condition.text"></p>
            <p class="text-2xl text-blue-700 font-bold" x-text="weatherData.current.temp_c + ' °C'"></p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-gray-700">
        <div class="bg-white rounded-lg shadow p-4">
            <p class="font-medium">Humedad</p>
            <p class="text-blue-600 font-semibold" x-text="weatherData.current.humidity + '%'"></p>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <p class="font-medium">Viento</p>
            <p class="text-blue-600 font-semibold" x-text="weatherData.current.wind_kph + ' km/h'"></p>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <p class="font-medium">País</p>
            <p class="text-blue-600 font-semibold" x-text="weatherData.location.country"></p>
        </div>
    </div>
</div>
