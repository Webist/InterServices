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
     * Always in service directory and they mostly use components form \handler namespace
     */
    const FILE = \App\Service\File::class;
    const DB_ADAPTER = \App\Service\Adapter::class;
    const IP_LOGGER = \App\Service\IpLogger::class;

    const CUSTOMER = \App\Service\Customer::class;
    const MAILER = \App\Service\Mailer::class;

    /**
     * Database names
     */
    const DATABASE_RELATIONAL = 'gym';
    const DATABASE_JOURNAL = 'gym';
    const DATABASE_LOGS = 'logs';
}
