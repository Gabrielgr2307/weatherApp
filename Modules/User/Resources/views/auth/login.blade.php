<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-tr from-blue-100 via-white to-blue-100 px-6">
        <div class="w-full max-w-md bg-white shadow-xl rounded-2xl p-8">
            <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Iniciar sesión</h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                    <input id="email" class="w-full border-gray-300 rounded-lg shadow-sm mt-1" type="email" name="email" value="{{ old('email') }}" required autofocus>
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                    <input id="password" class="w-full border-gray-300 rounded-lg shadow-sm mt-1" type="password" name="password" required autocomplete="current-password">
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mb-4">
                    <label class="flex items-center text-sm">
                        <input type="checkbox" name="remember" class="rounded border-gray-300">
                        <span class="ml-2 text-gray-600">Recordarme</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="text-sm text-blue-600 hover:underline" href="{{ route('password.request') }}">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif
                </div>

                <!-- Submit -->
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
                    Ingresar
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>


<!-- Scripts JS -->
<script src="{{ mix('js/app.js') }}"></script>
