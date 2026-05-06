<?php
declare(strict_types=1);

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

return function (): EntityManager {

    $paths = [__DIR__ . '/../src/Domain'];
    $isDevMode = true;

    $config = ORMSetup::createAttributeMetadataConfig($paths, $isDevMode);
    $config->enableNativeLazyObjects(true);

    $dbParams = [
        'driver' => $_ENV['DB_DRIVER'] ?? 'pdo_mysql',
        'host' => $_ENV['DB_HOST'] ?? '127.0.0.1',
        'dbname' => $_ENV['DB_NAME'] ?? null,
        'user' => $_ENV['DB_USER'] ?? null,
        'password' => $_ENV['DB_PASSWORD'] ?? null,
        'port' => $_ENV['DB_PORT'] ?? 3306,
        'charset' => 'utf8mb4',
    ];

    $connection = DriverManager::getConnection($dbParams, $config);

    return new EntityManager($connection, $config);
};