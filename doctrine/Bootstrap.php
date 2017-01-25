<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class Bootstrap {

    private $config;
    private $conn = array(
        'driver'   => 'pdo_mysql',
        'host'     => '127.0.0.1',
        'dbname'   => 'basedatos',
        'user'     => 'usuario',
        'password' => 'clave'
    );
    private $entityManager;
    private $isDevMode = true;
    
    function __construct() {
        require_once 'vendor/autoload.php';
        $this->config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . '/src'), $this->isDevMode);
        $this->entityManager = EntityManager::create($this->conn, $this->config);
    }

    function getEntityManager() {
        return $this->entityManager;
    }
}

?>