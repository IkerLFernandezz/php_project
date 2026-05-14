<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    /**
     * Show the login page. If already authenticated, bounce to the app.
     */
    public function showLogin(Request $request)
    {
        if ($request->session()->has('google_id_token')) {
            return redirect()->intended(route('courses.index'));
        }

        return view('auth.login');
    }

    /**
     * Kick off the OAuth dance. Socialite stores a state token in session and redirects.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->scopes(['openid', 'email', 'profile'])
            ->redirect();
    }

    /**
     * Handle Google's callback. We bypass Socialite::user() because it doesn't
     * surface the id_token; instead we validate the state manually and call
     * getAccessTokenResponse() directly to get the full token payload.
     */
    public function handleGoogleCallback(Request $request)
    {
        // User cancelled or Google returned an error.
        if ($request->has('error')) {
            return redirect()->route('login')->withErrors([
                'auth' => 'Inicio de sesión cancelado o rechazado por Google.',
            ]);
        }

        // Manual CSRF/state check (Socialite normally does this inside user()).
        $expectedState = $request->session()->pull('state');
        if (!$expectedState || $request->state !== $expectedState) {
            return redirect()->route('login')->withErrors([
                'auth' => 'Estado OAuth inválido. Vuelve a intentarlo.',
            ]);
        }

        try {
            $tokenResponse = Socialite::driver('google')->getAccessTokenResponse($request->code);
        } catch (\Throwable $e) {
            return redirect()->route('login')->withErrors([
                'auth' => 'No se pudo intercambiar el código con Google: ' . $e->getMessage(),
            ]);
        }

        $idToken = $tokenResponse['id_token'] ?? null;
        if (!$idToken) {
            return redirect()->route('login')->withErrors([
                'auth' => 'Google no devolvió un id_token. Comprueba que el scope "openid" está pedido.',
            ]);
        }

        // The id_token IS a JWT containing email/name/picture as claims.
        // We decode it just for display purposes — the backend re-verifies the
        // signature on every API call, so this unsigned decode is safe here.
        $claims = $this->decodeJwtClaims($idToken);

        $expiresIn = (int) ($tokenResponse['expires_in'] ?? 3600);

        $request->session()->regenerate();
        $request->session()->put([
            'google_id_token' => $idToken,
            // 30s safety margin so we don't send tokens that are about to expire.
            'google_id_token_expires_at' => time() + max(60, $expiresIn - 30),
            'user' => [
                'email' => $claims['email'] ?? null,
                'name' => $claims['name'] ?? ($claims['email'] ?? 'Usuario'),
                'picture' => $claims['picture'] ?? null,
            ],
        ]);

        return redirect()->intended(route('courses.index'));
    }

    /**
     * Wipe the session and send the user back to the login page.
     */
    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect()->route('login')->with('success', 'Has cerrado sesión.');
    }

    /**
     * Read the claims out of the middle segment of a JWT without verifying.
     * Verification is the backend's responsibility — here we only use these
     * values to show the user their name/avatar in the UI.
     */
    private function decodeJwtClaims(string $jwt): array
    {
        $parts = explode('.', $jwt);
        if (count($parts) !== 3) {
            return [];
        }

        $payload = base64_decode(strtr($parts[1], '-_', '+/'), true);
        if ($payload === false) {
            return [];
        }

        $decoded = json_decode($payload, true);
        return is_array($decoded) ? $decoded : [];
    }
}