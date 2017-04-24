<?php

namespace App\Spec;

interface Database
{
    const DATABASE = \App\Service\Database::class;

    const CREDENTIALS = [
        'protocol' => 'mysql',
        'username' => '',
        'passwd' => '',
        'host' => 'localhost',
        'port' => 3306,
        'dbname' => ''
    ];

    const PROTOCOL = 'mysql';
    const ADAPTER = \PDO::class;

    /**
     * Database connection(s) strings
     * @tip Use different strings for read, write, log, yesterday-data, older-data etc.
     * More secure, explicit, scalable and performs better.
     */
    const DATABASE_LOGS_CREDENTIALS_FILE = '/Spec/Credentials/.databaseLogsCredentials';
    const DATABASE_GYM_CREDENTIALS_FILE = '/Spec/Credentials/.databaseGymCredentials';
}