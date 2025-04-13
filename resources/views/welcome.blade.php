<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a WeatherApp</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-100 to-white min-h-screen flex items-center justify-center">
    <div class="text-center max-w-xl p-8 bg-white shadow-xl rounded-2xl">
        <h1 class="text-4xl font-extrabold text-blue-600 mb-4">☁️ WeatherApp</h1>
        <p class="text-gray-600 text-lg mb-6">
            Consulta el clima actual por ciudad, guarda tus lugares favoritos y accede rápidamente a tu historial.
        </p>
        @if (Route::has('login'))
        <div class="space-x-4">
            @auth
                <a href="{{ url('/dashboard') }}" class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition font-semibold">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition font-semibold">Iniciar sesión</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="bg-white border border-blue-600 text-blue-600 px-6 py-2 rounded-full hover:bg-blue-50 transition font-semibold">Registrarse</a>
                @endif
            @endauth
        </div>
    @endif

    </div>
</body>
</html>
