<?php

namespace App\Spec;

interface Database
{
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
}