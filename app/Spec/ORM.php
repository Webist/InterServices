<?php


namespace App\Spec;


interface ORM extends Main
{
    const DOCTRINE = \App\Service\DoctrineORM::class;
    const DOCTRINE_PATH_TO_ENTITY_FILES = ['app', 'handler'];

    const DOCTRINE_DEV_MODE = self::DEV_MODE;

    const DOCTRINE_QUERY_LOGGER = \Doctrine\DBAL\Logging\DebugStack::class;
}