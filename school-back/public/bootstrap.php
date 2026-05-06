<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use App\Infrastructure\Http\RouteCollection;
use App\Infrastructure\Http\Router;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$entityManagerFactory = require __DIR__ . '/../config/doctrine.php';
$entityManager = $entityManagerFactory();

$routes = new RouteCollection(__DIR__ . '/../config/routes.php');
$router = new Router($routes);

return ['router' => $router, 'em' => $entityManager];