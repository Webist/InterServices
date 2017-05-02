<?php

namespace App\Spec;

interface Main
{
    const DEV_MODE = true;

    const DATA_STORAGE_PATH = '../app/DataStorage/';

    const MAILER = \App\Service\Mailer::class;
    const EMAIL_TO = 'info@example.com';

    const ROOTPATH = \App\Service\RootPath::class;
    const CUSTOMER = \App\Service\Customer::class;
}
