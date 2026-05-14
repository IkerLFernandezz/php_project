<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAuthenticated
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->session()->get('google_id_token');
        $expiresAt = (int) $request->session()->get('google_id_token_expires_at', 0);

        if (!$token) {
            return $this->redirectToLogin($request, 'Inicia sesión para continuar.');
        }

        if ($expiresAt < time()) {
            $request->session()->forget(['google_id_token', 'google_id_token_expires_at', 'user']);
            return $this->redirectToLogin($request, 'Tu sesión ha caducado. Vuelve a iniciar sesión.');
        }

        return $next($request);
    }

    private function redirectToLogin(Request $request, string $reason)
    {
        // Remember the URL they were trying to reach so we can come back after login.
        if ($request->isMethod('GET') && !$request->expectsJson()) {
            $request->session()->put('url.intended', $request->fullUrl());
        }

        return redirect()->route('login')->with('error', $reason);
    }
}