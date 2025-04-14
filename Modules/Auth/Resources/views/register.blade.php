<link rel="stylesheet" href="{{ mix('css/app.css') }}">

<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-blue-500" />
            </a>
        </x-slot>

        <div class="text-center mb-4">
            <h1 class="text-xl font-bold text-gray-800">Crea tu cuenta</h1>
            <p class="text-sm text-gray-500">Regístrate para acceder a las funcionalidades de clima</p>
        </div>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                <x-input id="name" type="text" name="name" :value="old('name')" required autofocus class="w-full mt-1" />
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                <x-input id="email" type="email" name="email" :value="old('email')" required class="w-full mt-1" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <x-input id="password" type="password" name="password" required autocomplete="new-password" class="w-full mt-1" />
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar contraseña</label>
                <x-input id="password_confirmation" type="password" name="password_confirmation" required class="w-full mt-1" />
            </div>

            <div class="flex justify-between items-center mt-6">
                <a class="text-sm text-blue-600 hover:underline" href="{{ route('login') }}">
                    ¿Ya tienes una cuenta?
                </a>

                <x-button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md transition">
                    Registrarse
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
