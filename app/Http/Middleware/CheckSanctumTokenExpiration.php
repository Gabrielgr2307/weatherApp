<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSanctumTokenExpiration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->user()?->currentAccessToken();

        if ($token && config('sanctum.expiration')) {
            $createdAt = $token->created_at;
            $expiresAt = $createdAt->addMinutes(config('sanctum.expiration'));

            if (now()->greaterThan($expiresAt)) {
                $token->delete(); // opcional: revoca token
                return response()->json([
                    'message' => 'El token ha expirado. Por favor, inicie sesión nuevamente.'
                ], 401);
            }
        }

        return $next($request);
    }
}
