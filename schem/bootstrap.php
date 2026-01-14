<?php
require __DIR__ . '/vendor/autoload.php';

use App\Infrastructure\Routing\Router;
use App\Infrastructure\Routing\RouteCollection;
use App\Infrastructure\Http\Request;

$routes = new RouteCollection();
$method = new \Reflection;
//$method -> setAccesible(true);
$method -> invoke(__DIR__ . '/config/routes.php');

$app = new Router($routes);

$app->dispatch(new Request());