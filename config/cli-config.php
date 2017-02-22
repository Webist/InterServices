<?php
/**
 *
 */
require dirname(__DIR__) . '/vendor/autoload.php';

use Doctrine\ORM\Tools\Console\ConsoleRunner;

$doctrine = new App\Service\DoctrineEntityManager();
return ConsoleRunner::createHelperSet($doctrine->entityManager());