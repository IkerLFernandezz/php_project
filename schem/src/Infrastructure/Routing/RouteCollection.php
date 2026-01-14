<?php

namespace App\Infrastructure\Routing;

class RouteCollection{
    private array $routes = [];

    public function getRoutes(){
        return $this->routes;
    }
    
    public function add(string $method, string $path, callable|array $handler){
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'handler' => $handler,
        ];
    }

    public function loadFromFile (string $filePath): void{
        if(!file_exists($filePath)){
            throw new \Exception("Route file not found: " . $filePath);
        }
        $routes = require $filePath;

        if (!is_array($routes)) {
            throw new \Exception("Invalid route configuration, routes file must be an array");
        }

        foreach ($routes as $route) {
            if (!isset($route['method'], $route['path'], $route['handler'])) {
                throw new \Exception("Invalid route configuration, each route must have a method, path, and handler");
            }
            $this->add($route['method'], $route['path'], $route['handler']);
        }
    }
}