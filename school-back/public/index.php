<?php
declare(strict_types=1);

use App\Infrastructure\Http\Request;

$app = require __DIR__ . '/bootstrap.php';

$request = new Request();
$app['router']->dispatch($request, $app['em']);