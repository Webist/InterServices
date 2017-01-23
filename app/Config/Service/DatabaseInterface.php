<?php

namespace App\Config\Service;

interface DatabaseInterface
{
    const CREDENTIALS = [
        'protocol' => 'mysql',
        'username' => '',
        'passwd' => '',
        'host' => 'localhost',
        'port' => 3306,
        'dbname' => ''
    ];

    const DB_CONNECTION_PARAMS_FILE = '/App/Config/Credentials/.db';

    const PROTOCOL = 'mysql';
    const ADAPTER = \PDO::class;
}