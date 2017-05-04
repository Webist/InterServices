<?php

namespace App\Service;


class Database implements \App\Contract\Spec\Main
{
    private $connector;
    private $operator;

    /**
     * @var \mysqli|\PDO
     */
    private $adapter;

    public function __construct(\Connector\Database $connector, \App\Operator\Database $operator)
    {
        $this->connector = $connector;
        $this->operator = $operator;

        if ($this->adapter === null) {
            $this->adapter = $this->connectionOperations(
                dirname(__DIR__) . '/Contract/Spec/.private.inc', self::DATABASE_LOGS);
        }
    }

    private function connectionOperations($credentialsFile, $useDatabase)
    {
        return $this->connector->connection($credentialsFile, $useDatabase);
    }

    public function visitorLogOperations(array $params)
    {
        $query = "INSERT INTO visits SET route_id = :routeId, ip = :ip";
        $dbh = $this->adapter->prepare($query);

        $key = md5($query);
        $this->operator->addParams($key, $params);
        $this->operator->addStatement($key, $dbh);
    }

    public function execute()
    {
        /** @var \PDOStatement $operation */
        foreach ($this->operator->getStatements() as $key => $operation) {
            $operation->execute($this->operator->getParams($key));
        }
    }
}