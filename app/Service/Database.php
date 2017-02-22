<?php

namespace App\Service;


class Database extends DatabaseAbstract
{
    /**
     * Holds the callback as it was defined when this service was reflected
     * @example Query container to execute $visitsLoggerQuery = function($pdo) use ($params) {}
     *
     * @var \Closure
     */
    private $callback;

    public function __construct(\Closure $callback)
    {
        $this->callback = $callback;
    }

    public function handle($credentialsFile)
    {
        return call_user_func($this->callback, $this->db($credentialsFile));
    }
}