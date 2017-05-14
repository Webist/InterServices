<?php

namespace App\Service;


class Database implements \App\Contract\Spec\Main
{
    /**
     * @var \mysqli|\PDO
     */
    private $adapter;
    private $queries = [];
    private $operators = [];

    public function queries()
    {
        return $this->queries;
    }

    public function operators()
    {
        return $this->operators;
    }

    public function maintainVisitorLog(array $params)
    {
        \Assert\Assertion::keyExists($params, 'routeId');
        \Assert\Assertion::keyExists($params, 'ip');

        $query = "INSERT INTO visits SET route_id = :routeId, ip = :ip";
        $key = md5($query);
        $this->queries[$key]['statement'] = $query;
        $this->queries[$key]['params'] = $params;
    }

    public function setLifeCycleVisitorLog()
    {
        foreach ($this->queries as $key => $query) {
            $this->operators[$key]['statement'] = $this->adapter()->prepare($query['statement']);
            $this->operators[$key]['params'] = $query['params'];
        }
    }

    private function adapter()
    {
        if ($this->adapter === null) {
            $connector = new \Connector\Database();
            $this->adapter = $connector->connection(dirname(__DIR__) . '/Contract/Spec/.private.inc',
                self::DATABASE_LOGS);
        }
        return $this->adapter;
    }

    public function execute()
    {
        foreach ($this->operators as $key => $operator) {
            $operator['statement']->execute($operator['params']);
        }
    }
}