<?php

namespace Connector;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

class Doctrine
{
    /**
     * @var \Doctrine\ORM\Configuration
     */
    private $config;

    /**
     * @var \Journal\EntityEvent
     */
    private $eventListener;

    public function setConfig($entityFilesPath, $devMode)
    {
        $this->config = Setup::createAnnotationMetadataConfiguration(
            $entityFilesPath,
            $devMode);

        if($devMode) {
            $this->config->setSQLLogger(new \Doctrine\DBAL\Logging\DebugStack());
        }
    }

    public function setEventListener($listener)
    {
        $this->eventListener = $listener;
    }

    public function entityManager($dbParams)
    {
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

    public function getSQLLogger()
    {
        return $this->config->getSQLLogger();
    }
}