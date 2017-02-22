<?php


namespace App\Spec;


interface ORM
{
    const DOCTRINE = \App\Service\DoctrineEntityManager::class;
    const DOCTRINE_PATH_TO_ENTITY_FILES = ['app', 'handler'];
}