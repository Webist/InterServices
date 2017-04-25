<?php

namespace App\Service;

use App\Spec\ORM;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

class DoctrineORM implements ORM
{
    /**
     * @var \Doctrine\ORM\Configuration
     */
    private $config;

    /**
     * @var \Journal\EntityEvent
     */
    private $eventListener;

    /**
     * DoctrineORM constructor with config, either directly or via Service Container called.
     */
    public function __construct()
    {
        $this->config = Setup::createAnnotationMetadataConfiguration(
            self::DOCTRINE_PATH_TO_ENTITY_FILES,
            self::DOCTRINE_DEV_MODE);

        if(self::DOCTRINE_DEV_MODE) {
            $this->config->setSQLLogger(new \Doctrine\DBAL\Logging\DebugStack());
        }

        $this->eventListener = new \Journal\EntityEvent();
    }

    public function getSQLLogger()
    {
        return $this->config->getSQLLogger();
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function entityManager()
    {

        $db = new \Connector\Database();
        $credentials = $db->credentials(dirname(__DIR__) . self::DATABASE_GYM_CREDENTIALS_FILE);

        $dbParams = array(
            'driver'   => 'pdo_mysql',
            'host' => $credentials['host'],
            'user'     => $credentials['username'],
            'password' => $credentials['passwd'],
            'dbname'   => $credentials['dbname'],
        );
        $em = EntityManager::create($dbParams, $this->config);

        // When a (new) insert
        $em->getEventManager()->addEventListener(
            \Doctrine\ORM\Events::postPersist, $this->eventListener
        );

        // When update and there is a diff
        $em->getEventManager()->addEventListener(
            \Doctrine\ORM\Events::postUpdate, $this->eventListener
        );

        return $em;
    }
}