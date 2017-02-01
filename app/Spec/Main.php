<?php

namespace App\Spec;


interface Main
{
    const DATABASE = \App\Service\Database::class;

    const EMAIL_TO = 'info@example.com';
    const MAILER = \Mail\Mailer::class;
}
