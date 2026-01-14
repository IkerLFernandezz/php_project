<?php
require __DIR__ . '/bootstrap.php';
use App\Infrastructure\Http\Request;
$app->dispatch(new Request());