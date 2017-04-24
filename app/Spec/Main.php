<?php

namespace App\Spec;

interface Main
{
    const DEV_MODE = true;

    const MAILER = \Mail\Mailer::class;
    const EMAIL_TO = 'info@example.com';

    const CUSTOMER = \App\Service\Customer::class;

    const USER = \Account\User::class;
}
