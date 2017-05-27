<?php

namespace App\Contract\Spec;

interface Main
{
    const DEV_MODE = true;

    /**
     * App
     */
    const CONTROLLER_NAMESPACE = "App\\Controller\\";
    const SPEC_NAMESPACE = "App\\Spec\\";
    const INTERACTOR_NAMESPACE = "App\\InterActor\\";

    /**
     * Access/login parameters
     */
    const CREDENTIALS_FILE = '/Contract/Spec/.private.inc';

    /**
     * Service applications
     */
    const DB_CONNECTOR = \Connector\Database::class;
    const CUSTOMER = \App\Service\Customer::class;
    const MAILER = \App\Service\Mailer::class;

    /**
     * Database names
     */
    const DATABASE_RELATIONAL = 'gym';
    const DATABASE_JOURNAL = 'gym';
    const DATABASE_LOGS = 'logs';
}
