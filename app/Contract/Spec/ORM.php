<?php


namespace App\Contract\Spec;


interface ORM extends Database, Main
{
    const ORM = \Connector\ORM::class;
    const ORM_PATH_TO_ENTITY_FILES = ['app', 'handler'];

    const ORM_DEV_MODE = self::DEV_MODE;
}