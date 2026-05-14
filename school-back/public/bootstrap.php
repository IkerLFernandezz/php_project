<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Infrastructure\Auth\GoogleTokenVerifier;
use App\Infrastructure\Http\RouteCollection;
use App\Infrastructure\Http\Router;
use Dotenv\Dotenv;
use PHPUnit\Event\RuntimeException;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$entityManagerFactory = require __DIR__ . '/../config/doctrine.php';
$entityManager = $entityManagerFactory();

$googleClientId = $_ENV['GOOGLE_CLIENT_ID'] ?? null;
if (!$googleClientId) {
    throw new RuntimeException('GOOGLE_CLIENT_ID is not set in .env');
}

$cacheDir = __DIR__ . '/../var/cache';
if (!is_dir($cacheDir)) {
    mkdir($cacheDir, 0775, true);
}
$cache = new FilesystemAdapter(
    namespace: 'app',
    defaultLifetime: 0,
    directory: $cacheDir,
);

$tokenVerifier = new GoogleTokenVerifier(
    clientId: $googleClientId,
    cache: $cache,
);

$routes = new RouteCollection(__DIR__ . '/../config/routes.php');
$router = new Router($routes, $tokenVerifier);

return ['router' => $router, 'em' => $entityManager];