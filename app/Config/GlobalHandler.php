<?php
/**
 * Info
 * Created: 21/01/2017 21:07
 * User: fkus
 */

namespace App\Config;


interface GlobalHandler
{
    const DATABASE_SERVICE = \App\Service\Database::class;
    const MAILER = \Mail\Mailer::class;
}