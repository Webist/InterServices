<?php

namespace App\Service;


class Database implements \App\Contract\Spec\Main
{
    /**
     * @var \mysqli|\PDO
     */
    private $adapter;

    private $operations = [];

    private $statements = [
        'visitorLog' => "INSERT INTO visits SET route_id = :routeId, ip = :ip"
    ];

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

        $queries['visitorLog']['query'] = $this->statements['visitorLog'];
        $queries['visitorLog']['params'] = $params;

        return $queries;
    }

    /**
     * @param array $queries
     * @return $this
     */
    public function mutationMapOperations(array $queries)
    {
        $operations = [];
        foreach ($queries as $operation) {
            $operations[] = [
                'statement' => $this->adapter()->prepare($operation['query']),
                'parameters' => $operation['params']
            ];
        }

        return $operations;
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
     * @param array $operations
     * @return __anonymous@1656
     */
    public function mutate(array $operations)
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

        foreach ($operations as $operation) {
            if (!$operation['statement']->execute($operation['parameters'])) {
                $returnValue->setState(false);
            }
        }

        return $returnValue;
    }
}