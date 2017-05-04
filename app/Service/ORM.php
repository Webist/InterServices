<?php

namespace App\Service;


class ORM implements \App\Contract\Spec\ORM
{
    private $em;

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function entityManager()
    {
        if ($this->em === null) {
            $doctrine = new \Connector\Doctrine();
            $doctrine->setConfig(self::ORM_PATH_TO_ENTITY_FILES, self::ORM_DEV_MODE);
            $doctrine->setEventListener(new \Journal\EntityEvent());

            $db = new \Connector\Database();
            $credentials = $db->credentials(dirname(__DIR__) . '/Contract/Spec/.private.inc',
                self::DATABASE_RELATIONAL);

            return $this->em = $doctrine->entityManager(
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