<?php
declare(strict_types=1);

namespace App\Infrastructure\Auth;

use Firebase\JWT\JWK;
use Firebase\JWT\JWT;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Throwable;

final class GoogleTokenVerifier
{
    private const JWKS_URI = 'https://www.googleapis.com/oauth2/v3/certs';
    private const ALLOWED_ISSUERS = ['accounts.google.com', 'https://accounts.google.com'];
    private const CACHE_KEY = 'google_oauth_jwks';
    private const CACHE_TTL = 3600;

    public function __construct(
        private string $clientId,
        private CacheInterface $cache,
    ) {
    }

    public function verify(string $idToken): AuthenticatedUser
    {
        try {
            $jwks = $this->fetchJwks();
            $decoded = JWT::decode($idToken, JWK::parseKeySet($jwks));
        } catch (AuthException $e) {
            throw $e;
        } catch (Throwable $e) {
            throw new AuthException('Invalid token: ' . $e->getMessage());
        }

        $payload = (array) $decoded;

        if (!in_array($payload['iss'] ?? '', self::ALLOWED_ISSUERS, true)) {
            throw new AuthException('Invalid token issuer');
        }

        if (($payload['aud'] ?? '') !== $this->clientId) {
            throw new AuthException('Token not issued for this application');
        }

        if (empty($payload['sub']) || empty($payload['email'])) {
            throw new AuthException('Token is missing required claims');
        }

        return new AuthenticatedUser(
            googleId: (string) $payload['sub'],
            email: (string) $payload['email'],
            name: (string) ($payload['name'] ?? $payload['email']),
        );
    }

    private function fetchJwks(): array
    {
        return $this->cache->get(self::CACHE_KEY, function (ItemInterface $item): array {
            $item->expiresAfter(self::CACHE_TTL);

            $json = @file_get_contents(self::JWKS_URI);
            if ($json === false) {
                throw new AuthException('Could not reach Google to fetch signing keys');
            }

            $jwks = json_decode($json, true);
            if (!is_array($jwks) || !isset($jwks['keys'])) {
                throw new AuthException('Malformed JWKs response from Google');
            }

            return $jwks;
        });
    }
}