<?php
declare(strict_types=1);

namespace App\Infrastructure\Http;

use App\Infrastructure\Auth\AuthenticatedUser;

class Request
{
    private string $method;
    private string $uri;
    /** @var array<string,string> header name (lowercased) → value */
    private array $headers;
    private ?AuthenticatedUser $user = null;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $this->uri = $_SERVER['REQUEST_URI'] ?? '/';
        $this->headers = $this->extractHeaders();
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getHeader(string $name): ?string
    {
        return $this->headers[strtolower($name)] ?? null;
    }

    public function setUser(?AuthenticatedUser $user): void
    {
        $this->user = $user;
    }

    /** Available inside controllers after the auth middleware ran. Null on public routes. */
    public function getUser(): ?AuthenticatedUser
    {
        return $this->user;
    }

    /**
     * Apache often strips Authorization on PHP-FPM unless explicitly forwarded.
     * If `getallheaders` isn't available or doesn't see Authorization, we walk $_SERVER too.
     *
     * @return array<string,string>
     */
    private function extractHeaders(): array
    {
        $headers = [];

        if (function_exists('getallheaders')) {
            foreach (getallheaders() as $name => $value) {
                $headers[strtolower($name)] = (string) $value;
            }
        }

        foreach ($_SERVER as $name => $value) {
            if (str_starts_with($name, 'HTTP_')) {
                $key = strtolower(str_replace('_', '-', substr($name, 5)));
                if (!isset($headers[$key])) {
                    $headers[$key] = (string) $value;
                }
            }
        }

        // Some setups expose Authorization specifically through this:
        if (!isset($headers['authorization']) && isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
            $headers['authorization'] = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
        }

        return $headers;
    }
}