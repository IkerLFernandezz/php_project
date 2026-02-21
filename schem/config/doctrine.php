<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '../.env');
$dotenv->load();

return function () {
    $paths = [__DIR__ . '/../src/Domain'];
    $isDevMode = true;
    $config = ORMSetup::createAttributeMetadataConfig($paths, $isDevMode);

    $dbParams = [
        'driver' => 'pdo_sqlite',
        'path' => "database/db.sqlite",
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
        'dbname' => $_ENV['DB_NAME'],
    ];

    $connection = DriverManager::getConnection($dbParams, $config);

    return new EntityManager($connection, $config);
};