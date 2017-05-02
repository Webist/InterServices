<?php

namespace App\Service;


class ORM implements \App\Spec\ORM
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
            $credentials = $db->credentials(dirname(__DIR__) . self::DATABASE_GYM_CREDENTIALS_FILE);

            $dbParams = array(
                'driver' => 'pdo_mysql',
                'host' => $credentials['host'],
                'user' => $credentials['username'],
                'password' => $credentials['passwd'],
                'dbname' => $credentials['dbname'],
            );
            return $this->em = $doctrine->entityManager($dbParams);
        }
        return $this->em;
    }
}