<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <!-- Mostrar errores específicos -->
        @if ($errors->has('error'))
            <div class="alert alert-danger">
                {{ $errors->first('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('user.login') }}">
            @csrf
            <div class="form-group">
                <label for="email">{{ __('Email') }}</label>
                <input id="email" type="email" class="form-control" name="email" :value="old('email')" required
                    autofocus>
            </div>
            <div class="form-group">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control" name="password" required
                    autocomplete="current-password">
            </div>
            <div class="form-check">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <label class="form-check-label" for="remember_me">{{ __('Remember me') }}</label>
            </div>
            <div class="d-flex justify-content-between mt-4">
                @if (Route::has('password.request'))
                    <a class="text-muted" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
                <button type="submit" class="btn btn-primary">
                    {{ __('Log in') }}
                </button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

<!-- Scripts JS -->
<script src="{{ mix('js/app.js') }}"></script>
