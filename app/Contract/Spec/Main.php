<?php

namespace App\Contract\Spec;

interface Main
{
    const DEV_MODE = true;

    /**
     * Service managers
     */
    const CUSTOMER = \App\Service\Customer::class;
    const MAILER = \App\Service\Mailer::class;
    const EMAIL_TO = 'info@example.com';

    /**
     * Database names
     */
    const DATABASE_RELATIONAL = 'gym';
    const DATABASE_JOURNAL = 'gym';
    const DATABASE_LOGS = 'logs';
}
