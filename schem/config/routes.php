<?php

use App\Controllers\HomeController;
use App\Controllers\RegisterController;;
use App\Controllers\UserController;

return [

    [
        'method' => 'GET',
        'path' => '/',
        'handler' => [HomeController::class, 'index']
    ],
    [
        'method' => 'GET',
        'path' => '/login',
        'handler' => [HomeController::class, 'login']
    ],
    [
        'method' => 'GET',
        'path' => '/login',
        'handler' => [HomeController::class, 'login']
    ],
    [
        'method' => 'POST',
        'path' => '/signup',
        'handler' => [RegisterController::class, 'signup']
    ],
    [
        'method' => 'GET',
        'path' => '/user/edit/{id}',
        'handler' => [UserController::class, 'edit']
    ]
];
