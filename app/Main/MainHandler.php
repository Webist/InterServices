<?php

namespace App\Main;


interface MainHandler
{
    const DATABASE_SERVICE = \App\Service\Database::class;
    const MAILER = \Mail\Mailer::class;
}