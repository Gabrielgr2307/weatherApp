<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    use HasApiTokens;
    //


    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
        return response()->json([
            'message' => 'Usuario registrado exitosamente',
            'user' => $user,
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        Log::info('Orden de inicio de sesión recibida', [
            'request' => $request->all(),
            'fecha' => now()->format('Y-m-d')
        ]);


        $validated = $request->validated();
        $user = User::where('email', $validated['email'])->first();
        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }
        try {
            $token = $user->createToken('token')->plainTextToken;
            return response()->json([
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                ],
                'token' => [
                    'token' => $token,
                    'expires_in' => config('sanctum.expiration') * 60
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ha ocurrido un error en el servidor: ' . $e->getMessage()], 500);
        }
    }

    public function home(Request $request)
    {
        return response()->json([
            'user' => [
                'name' => $request->user()->name,
                'email' => $request->user()->email,
            ],
            'mensaje' => 'Bienvenido a la API',
        ]);
    }

    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken();

        if (!$token) {
            return response()->json(['message' => 'El token ya ha sido revocado o no existe.'], 400);
        }

        $token->delete();

        return response()->json(['message' => 'Sesión cerrada correctamente.'], 200);
    }

}
