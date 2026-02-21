<?php
declare(strict_types=1);

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

return function (): EntityManager {

    $paths = [__DIR__ . '/../src/Domain'];
    $isDevMode = true;

    $config = ORMSetup::createAttributeMetadataConfig($paths, $isDevMode);
    $config->enableNativeLazyObjects(true);

    $dbParams = [
        'driver' => getenv('DB_DRIVER'),
        'host' => getenv('DB_HOST'),
        'dbname' => getenv('DB_NAME'),
        'user' => getenv('DB_USER'),
        'password' => getenv('DB_PASSWORD'),
        'charset' => 'utf8mb4',
    ];

    $connection = DriverManager::getConnection($dbParams, $config);

    return new EntityManager($connection, $config);
};
