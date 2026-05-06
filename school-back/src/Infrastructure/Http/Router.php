<?php
declare(strict_types=1);

namespace App\Infrastructure\Http;

use App\Infrastructure\Http\Request;
use Doctrine\ORM\EntityManagerInterface;

class Router
{
    public function __construct(private RouteCollection $routeCollection) {}

    public function dispatch(Request $request, EntityManagerInterface $em): void
    {
        $routes = $this->routeCollection->getRoutes();
        $uri = parse_url($request->getUri(), PHP_URL_PATH);

        foreach ($routes as $route) {
            if (
                $route['method'] === strtoupper($request->getMethod()) &&
                $this->matchUri($route['path'], $uri, $params)
            ) {
                [$controllerClass, $action] = $route['handler'];
                $controller = new $controllerClass($request, $em);
                call_user_func_array([$controller, $action], $params);
                return;
            }
        }

        JsonResponse::send([
            'error' => 'Not Found',
            'path'  => $uri,
            'method' => strtoupper($request->getMethod()),
        ], 404);
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