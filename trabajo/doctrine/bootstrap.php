<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once '../../clases/vendor/autoload.php';

$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . '/src'), $isDevMode);

$conn = array(
    'driver'   => 'pdo_mysql',
    'host'     => '127.0.0.1',
    'dbname'   => 'wp',
    'user'     => 'uwp',
    'password' => 'cwp'
);

$entityManager = EntityManager::create($conn, $config);