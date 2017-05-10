<?php

namespace App\Service;


class Database implements \App\Contract\Spec\Main
{
    private $connector;

    /**
     * @var \mysqli|\PDO
     */
    private $adapter;

    private $operators = [];

    public function __construct(\Connector\Database $connector)
    {
        $this->connector = $connector;

        if ($this->adapter === null) {
            $this->adapter = $this->connector->connection(dirname(__DIR__) . '/Contract/Spec/.private.inc',
                self::DATABASE_LOGS);
        }
    }

    public function operators()
    {
        return $this->operators;
    }

    public function visitorLogOperations(array $params)
    {
        $query = "INSERT INTO visits SET route_id = :routeId, ip = :ip";

        $key = md5($query);
        $this->operators['statements'][$key] = $this->adapter->prepare($query);
        $this->operators['params'][$key] = $params;
    }

    public function execute()
    {
        foreach ($this->operators['statements'] as $key => $operation) {
            $operation->execute($this->operators['params'][$key]);
        }
    }
}