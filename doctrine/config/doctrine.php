<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$config = ORMSetup::createAttributeMetadataConfig(
    paths: [__DIR__ . '/../src'],
    isDevMode: true,
);

if (PHP_VERSION_ID > 80400) {
    $config->enableNativeLazyObjects(true);
}

$dbParams = [
    'driver' => 'pdo_sqlite',
    'path' => "database/db.sqlite",
    'user' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASSWORD'],
    'dbname' => $_ENV['DB_NAME'],
];

$connection = DriverManager::getConnection($dbParams, $config);
$entityManager = new EntityManager($connection, $config);