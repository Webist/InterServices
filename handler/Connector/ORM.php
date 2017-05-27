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
     * @throws \Exception
     */
    public function entityManager()
    {
        if ($this->em === null) {

            $this->setConfig(self::ORM_PATH_TO_ENTITY_FILES, self::ORM_DEV_MODE);
            $this->setEventListener(new \Journal\EntityEvent());

            $connector = new \Connector\Database();

            $credentialsFile = dirname(dirname(__DIR__)) . '/app/Contract/Spec/.private.inc';
            if (!file_exists($credentialsFile)) {
                throw new \Exception(sprintf('Not found, file `%s` for %s ', $credentialsFile, __METHOD__));
            }

            if (false === ($credentials = @file_get_contents($credentialsFile))) {
                throw new \Exception(sprintf('Could not get content, file `%s` for %s ', $credentialsFile, __METHOD__));
            }

            $credentials = $connector->credentials($credentials, self::DATABASE_RELATIONAL);

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