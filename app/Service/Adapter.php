<?php


namespace App\Service;


class Adapter
{
    private $credentials;

    public function maintainUnit(array $credentials)
    {
        $this->credentials = $credentials;
        return $this;
    }

    public function get(string $databaseName)
    {
        $connector = new \Connector\Database();
        return $connector->connection($this->credentials, $databaseName);
    }

}