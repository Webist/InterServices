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

    private $statements = [
        'visitorLog' => "INSERT INTO visits SET route_id = :routeId, ip = :ip"
    ];

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
     * @return array
     */
    public function maintainMutationMap(array $params)
    {
        \Assert\Assertion::keyExists($params, 'routeId');
        \Assert\Assertion::keyExists($params, 'ip');

        $this->queries['visitorLog']['query'] = $this->statements['visitorLog'];
        $this->queries['visitorLog']['params'] = $params;

        return $this->queries;
    }

    /**
     * @param array $operations
     * @return $this
     */
    public function prepareOperations(array $operations)
    {
        foreach ($operations as $operation) {
            $this->operations[] = [
                'statement' => $this->adapter()->prepare($operation['query']),
                'parameters' => $operation['params']
            ];
        }

        return $this;
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
    public function mutate()
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

        foreach ($this->operations as $operation) {
            if (!$operation['statement']->execute($operation['parameters'])) {
                $returnValue->setState(false);
            }
        }

        return $returnValue;
    }
}