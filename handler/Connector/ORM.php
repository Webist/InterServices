<?php

namespace Connector;


class ORM implements \App\Contract\Spec\ORM
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    /**
     * @var \Doctrine\ORM\Configuration
     */
    private $config;
    /**
     * @var \Journal\EntityEvent
     */
    private $eventListener;

    private function setConfig($entityFilesPath, $devMode)
    {
        $this->config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
            $entityFilesPath,
            $devMode);

        if ($devMode) {
            $this->config->setSQLLogger(new \Doctrine\DBAL\Logging\DebugStack());
        }
    }

    private function setEventListener($listener)
    {
        $this->eventListener = $listener;
    }

    private function getEntityManager($dbParams)
    {
        $em = \Doctrine\ORM\EntityManager::create($dbParams, $this->config);

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

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function entityManager()
    {
        if ($this->em === null) {

            $this->setConfig(self::ORM_PATH_TO_ENTITY_FILES, self::ORM_DEV_MODE);
            $this->setEventListener(new \Journal\EntityEvent());

            $db = new \Connector\Database();
            $credentials = $db->credentials(dirname(dirname(__DIR__)) . '/app/Contract/Spec/.private.inc',
                self::DATABASE_RELATIONAL);

            return $this->em = $this->getEntityManager(
                [
                    'driver' => 'pdo_mysql',
                    'host' => $credentials['host'],
                    'user' => $credentials['username'],
                    'password' => $credentials['passwd'],
                    'dbname' => $credentials['dbname'],
                ]
            );
        }
        return $this->em;
    }
}