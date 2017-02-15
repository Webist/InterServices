<?php

namespace App\Service;


class Database extends DatabaseAbstract
{
    private $callback;

    public function __construct(\Closure $callback)
    {
        // Query container to execute
        $this->callback = $callback;
    }

    public function handle($credentialsFile)
    {
        return call_user_func($this->callback, $this->db($credentialsFile));
    }
}