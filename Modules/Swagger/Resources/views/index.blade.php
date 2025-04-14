blade
<x-app-layout>
    <title>{{ config('l5-swagger.api.title') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Source+Code+Pro:300,600|Titillium+Web:400,600,700" rel="stylesheet">

    <!-- Cargar los estilos y scripts de Swagger -->
    <link rel="stylesheet" type="text/css" href="{{ l5_swagger_asset('swagger-ui.css', 'v1') }}">
    <script src="{{ l5_swagger_asset('swagger-ui-bundle.js', 'v1') }}"></script>
    <script src="{{ l5_swagger_asset('swagger-ui-standalone-preset.js', 'v1') }}"></script>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 leading-tight">
            📘 Documentación de la API - WeatherApp
        </h2>
    </x-slot>
    <div class="py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-200">
            <div class="mb-6">
                <p class="text-gray-600 text-sm">
                    Aquí encontrarás todas las rutas disponibles de tu API, organizadas por módulos y funcionalidades. Puedes probarlas directamente desde esta vista.
                </p>
            </div>
            <div id="swagger-ui" class="overflow-hidden rounded-lg border border-gray-100"></div>
        </div>
    </div>
    <script>
        const ui = SwaggerUIBundle({
            url: '{{ route('l5-swagger.versions.latest.json') }}', // Ruta a tu archivo JSON
            dom_id: '#swagger-ui',
            presets: [
                SwaggerUIStandalonePreset
            ],
            layout: "StandaloneLayout"
        });
    </script>
</x-app-layout>
