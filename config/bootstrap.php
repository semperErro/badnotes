<?php
// bootstrap.php
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Setup;


const BASEDIR = __DIR__ . '/../';

require_once BASEDIR . '/vendor/autoload.php';


function getEntityManager(): EntityManager
{
    $isDevMode = true;
    $proxyDir = null;
    $cache = null;
    $useSimpleAnnotationReader = false;
    $config = Setup::createAnnotationMetadataConfiguration(array(BASEDIR . '/src'), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);

    $connectionParams = array(
        'dbname' => 'badnotes',
        'user' => 'baduser',
        'password' => 'foobarbaz',
        'host' => 'db',
        'driver' => 'pdo_mysql'
    );

    $conn = null;
    try {
        $conn = DriverManager::getConnection($connectionParams, $config);
    } catch (\Doctrine\DBAL\Exception $e) {
        echo $e->getMessage();
        exit(1);
    }

    $entityManager = null;
    try {
        $entityManager = EntityManager::create($conn, $config);
    } catch (ORMException $e) {
        echo $e->getMessage();
        exit(1);
    }

    return $entityManager;
}
