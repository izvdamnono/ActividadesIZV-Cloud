<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class Bootstrap {

    private $config;
    private $conn = array(
        'driver'   => 'pdo_mysql',
        'host'     => '127.0.0.1',
        'dbname'   => 'wp',
        'user'     => 'uwp',
        'password' => 'cwp'
    );
    private $entityManager;
    private $isDevMode = true;
    
    function __construct() {
        require_once 'vendor/autoload.php';
        $this->config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . '/datos'), $this->isDevMode);
        $this->entityManager = EntityManager::create($this->conn, $this->config);
    }

    function getEntityManager() {
        return $this->entityManager;
    }
}

?>