<?php

namespace App\Contract\Spec;

interface Main
{
    const DEV_MODE = true;

    const DATA_STORAGE_PATH = '../app/DataStorage/';

    const DATABASE_RELATIONAL = 'gym';
    const DATABASE_JOURNAL = 'gym';
    const DATABASE_LOGS = 'logs';

    const MAILER = \App\Service\Mailer::class;
    const EMAIL_TO = 'info@example.com';

    const ROOT_PATH = \App\Service\RootPath::class;
    const CUSTOMER = \App\Service\Customer::class;
}
