<?php
require __DIR__ . '/bootstrap.php';

use App\Infrastructure\Http\Request;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$app->dispatch(new Request());