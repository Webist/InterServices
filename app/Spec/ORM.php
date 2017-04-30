<?php


namespace App\Spec;


interface ORM extends Database, Main
{
    const ORM = \App\Service\ORM::class;
    const ORM_PATH_TO_ENTITY_FILES = ['app', 'handler'];

    const ORM_DEV_MODE = self::DEV_MODE;
}