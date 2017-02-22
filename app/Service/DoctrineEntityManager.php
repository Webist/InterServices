<?php

namespace App\Service;

use App\Spec\ORM;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;


class DoctrineEntityManager extends DatabaseAbstract implements ORM
{
    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function entityManager()
    {
        $credentials = $this->credentials(dirname(__DIR__) . self::DATABASE_GYM_CREDENTIALS_FILE);
        $dbParams = array(
            'driver'   => 'pdo_mysql',
            'host' => $credentials['host'],
            'user'     => $credentials['username'],
            'password' => $credentials['passwd'],
            'dbname'   => $credentials['dbname'],
        );

        $isDevMode = false;
        $config = Setup::createAnnotationMetadataConfiguration(
            self::DOCTRINE_PATH_TO_ENTITY_FILES,
            $isDevMode);

        return EntityManager::create($dbParams, $config);
    }
}