<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Http;
class RefreshToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Obtener los tokens de la sesión
        $accessToken = session('access_token');
        $refreshToken = session('refresh_token');

        if (!$accessToken) {
            return redirect()->route('login');
        }

        // Verificar si el token ha expirado
        $response = Http::withToken($accessToken)->get(env('APP_URL_AUTH').'api/v1/auth/validate-user');

        // Si el token está expirado, intenta renovarlo
        if ($response->status() === 401 && $refreshToken) {
            $renewResponse = Http::asForm()->post(env('APP_URL_AUTH').'api/v1/auth/refresh-token', [
                'refresh_token' => $refreshToken,
            ]);

            if ($renewResponse->successful()) {
                // Guardar los nuevos tokens en la sesión
                $tokens = $renewResponse->json();
                session([
                    'access_token' => $tokens['data']['access_token'],
                    'refresh_token' => $tokens['data']['refresh_token'],
                ]);
            } else {
                return redirect()->route('login')->with('error', 'Tu sesión ha expirado. Inicia sesión nuevamente.');
            }
        }

        return $next($request);
    }
}
