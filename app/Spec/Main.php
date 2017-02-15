<?php

namespace App\Spec;


interface Main
{
    const DATABASE = \App\Service\Database::class;
    /**
     * Database connection(s) strings
     * @tip Use different strings for read, write, log, yesterday-data, older-data etc. More secure, explicit, scalable and performs better.
     */
    const DATABASE_LOGS_CREDENTIALS_FILE = '/App/Spec/Credentials/.databaseLogsCredentials';
    const DATABASE_GYM_CREDENTIALS_FILE = '/App/Spec/Credentials/.databaseGymCredentials';

    const MAILER = \Mail\Mailer::class;
    const EMAIL_TO = 'info@example.com';

    const CUSTOMER = \Commerce\Customer::class;
}
