<?php

namespace App\Spec;


interface Main
{
    const MAILER = \Mail\Mailer::class;
    const EMAIL_TO = 'info@example.com';

    const CUSTOMER = \App\Service\Customer::class;
}
