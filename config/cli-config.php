<?php
/**
 *
 */
require dirname(__DIR__) . '/vendor/autoload.php';

use Doctrine\ORM\Tools\Console\ConsoleRunner;

/**
class enumString {
    public static function getMappedDatabaseTypes()
    {
        return ["enum" => "string"];
    }
}
\Doctrine\DBAL\Types\Type::addType('enum', 'enumString');
 */

$orm = new Connector\ORM();
return ConsoleRunner::createHelperSet($orm->entityManager());