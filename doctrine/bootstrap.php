<?php

require_once "vendor/autoload.php";

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

$config = ORMSetup::createAttributeMetadataConfig( // on PHP < 8.4, use ORMSetup::createAttributeMetadataConfiguration()
    paths: [__DIR__ . '/config/xml'],
    isDevMode: true,
);
if (PHP_VERSION_ID > 80400) {
    $config->enableNativeLazyObjects(true);
}

$connection = DriverManager::getConnection([
    'driver' => 'pdo_sqlite',
    'path' => __DIR__ . '/database/db.sqlite',
], $config);
$entityManager = new EntityManager($connection, $config);