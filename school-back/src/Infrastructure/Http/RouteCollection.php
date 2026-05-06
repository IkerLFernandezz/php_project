<?php
declare(strict_types=1);

namespace App\Infrastructure\Http;

use Exception;

class RouteCollection
{
    private array $routes = [];

    public function __construct(string $routesFile)
    {
        if ($routesFile) {
            $this->loadFromFile($routesFile);
        }
    }

    public function add(string $method, string $path, callable|array $handler): void
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'handler' => $handler,
        ];
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    private function loadFromFile(string $filePath): void
    {
        if (!file_exists($filePath)) {
            throw new Exception("Routes file not found: $filePath");
        }
        $routes = require $filePath;
        if (!is_array($routes)) {
            throw new Exception("Routes file must return an array: $filePath");
        }
        foreach ($routes as $route) {
            if (!isset($route['method'], $route['path'], $route['handler'])) {
                throw new Exception("Each route must have 'method', 'path', and 'handler' keys");
            }
            $this->add($route['method'], $route['path'], $route['handler']);
        }
    }
}