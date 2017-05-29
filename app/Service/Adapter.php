<?php


namespace App\Service;


class Adapter
{
    private $credentials;

    /**
     * @param array $credentials
     * @return $this
     */
    public function maintainCredentials(array $credentials)
    {
        $this->credentials = $credentials;
        return $this;
    }

    public function connection(string $databaseName)
    {
        $connector = new \Connector\Database();
        return $connector->connection($this->credentials, $databaseName);
    }

}