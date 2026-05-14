<?php
declare(strict_types=1);

namespace App\Infrastructure\Http;

use App\Infrastructure\Auth\AuthenticatedUser;
use App\Infrastructure\Auth\AuthException;
use App\Infrastructure\Auth\GoogleTokenVerifier;
use Doctrine\ORM\EntityManagerInterface;

class Router
{
    public function __construct(
        private RouteCollection $routeCollection,
        private GoogleTokenVerifier $tokenVerifier,
    ) {
    }

    public function dispatch(Request $request, EntityManagerInterface $em): void
    {
        $routes = $this->routeCollection->getRoutes();
        $uri = parse_url($request->getUri(), PHP_URL_PATH);

        foreach ($routes as $route) {
            if (
                $route['method'] === strtoupper($request->getMethod()) &&
                $this->matchUri($route['path'], $uri, $params)
            ) {
                if (empty($route['public'])) {
                    try {
                        $request->setUser($this->authenticate($request));
                    } catch (AuthException $e) {
                        JsonResponse::send([
                            'error' => 'Unauthorized',
                            'message' => $e->getMessage(),
                        ], 401);
                        return;
                    }
                }

                [$controllerClass, $action] = $route['handler'];
                $controller = new $controllerClass($request, $em);
                call_user_func_array([$controller, $action], $params);
                return;
            }
        }

        JsonResponse::send([
            'error' => 'Not Found',
            'path' => $uri,
            'method' => strtoupper($request->getMethod()),
        ], 404);
    }

    private function authenticate(Request $request): AuthenticatedUser
    {
        $header = $request->getHeader('Authorization');
        if (!$header || !str_starts_with($header, 'Bearer ')) {
            throw new AuthException('Missing or malformed Authorization header');
        }

        $token = trim(substr($header, 7));
        if ($token === '') {
            throw new AuthException('Empty bearer token');
        }

        return $this->tokenVerifier->verify($token);
    }

    private function matchUri(string $routePath, string $requestUri, &$params): bool
    {
        $pattern = '#^' . preg_replace('#\{(\w+)\}#', '(?P<$1>[^/]+)', $routePath) . '$#';
        if (preg_match($pattern, $requestUri, $matches)) {
            $params = array_filter($matches, fn($k) => is_string($k), ARRAY_FILTER_USE_KEY);
            return true;
        }
        return false;
    }
}