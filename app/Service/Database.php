<?php

namespace App\Service;


class Database
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

    /**
     * Handles the callback
     * @param null $credentialsFile when used, overrides default credentials file
     * @return mixed
     */
    public function invoke($credentialsFile = null)
    {
        $db = new \Connector\Database();
        return call_user_func($this->callback, $db->connection($credentialsFile));
    }
}