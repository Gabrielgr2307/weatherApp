<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use App\Http\Requests\RegisterRequest;

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
        try {
            $validated = $request->validated();
            $user = User::where('email', $validated['email'])->first();
            if (!$user || !Hash::check($validated['password'], $user->password)) {
                return response()->json(['error' => 'Credenciales inválidas'], 401);
            }

            return response()->json([
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                ],
                'token' => [
                    'token' => $user->createToken('token')->plainTextToken,
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

}
