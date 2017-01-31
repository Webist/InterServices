<?php

namespace App\Spec;


interface MainHandler
{
    const DATABASE_SERVICE = \App\Service\Database::class;
    const MAILER = \Mail\Mailer::class;
}