<?php

namespace App\Service;


class Database implements \App\Contract\Spec\Main
{
    /**
     * @var \mysqli|\PDO
     */
    private $adapter;
    private $queries = [];
    private $operations = [];

    public function queries()
    {
        return $this->queries;
    }

    public function operators()
    {
        return $this->operations;
    }

    /**
     * @param array $params
     * @return bool
     */
    public function maintainArrayMap(array $params)
    {
        \Assert\Assertion::keyExists($params, 'routeId');
        \Assert\Assertion::keyExists($params, 'ip');

        $query = "INSERT INTO visits SET route_id = :routeId, ip = :ip";
        $key = md5($query);
        $this->queries[$key]['statement'] = $query;
        $this->queries[$key]['params'] = $params;
        return true;
    }

    /**
     * @return bool
     */
    public function setArrayMapOperations()
    {
        foreach ($this->queries as $key => $query) {
            $this->operations[$key]['statement'] = $this->adapter()->prepare($query['statement']);
            $this->operations[$key]['params'] = $query['params'];
        }
        return true;
    }

    /**
     * @return \mysqli|\PDO
     */
    private function adapter()
    {
        if ($this->adapter === null) {
            $connector = new \Connector\Database();
            $this->adapter = $connector->connection(dirname(__DIR__) . '/Contract/Spec/.private.inc',
                self::DATABASE_LOGS);
        }
        return $this->adapter;
    }

    /**
     * @return __anonymous@1604
     */
    public function execute()
    {
        $returnValue = new class
        {
            private $state = true;

            public function setState(bool $state)
            {
                $this->state = $state;
            }

            public function state(): bool
            {
                return $this->state;
            }
        };

        foreach ($this->operations as $key => $operation) {
            if (!$operation['statement']->execute($operation['params'])) {
                $returnValue->setState(false);
            }
        }

        return $returnValue;
    }
}