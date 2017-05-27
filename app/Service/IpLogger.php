<?php

namespace App\Service;

/**
 * Data-centric domain service.
 * This means communications are done with a database.
 * Model and Relations live in database via join, stored procedures.
 *
 * Class Database
 * @package App\Service
 */
class IpLogger
{
    /** @var actual operator holder */
    private $operator;
    /** Use a public constant for operator agreement */
    const OPERATOR_VISITOR_LOG = 'log visits';

    /** @var array queries map (model) to hide */
    private $queries = [
        self::OPERATOR_VISITOR_LOG => [
            "INSERT INTO visits SET route_id = :routeId, ip = :ip"
        ]
    ];

    /**
     * @var \mysqli|\PDO
     */
    private $adapter;

    private function operator($operator)
    {
        $this->operator = $operator;
        return $this;
    }

    private function queryUnit()
    {
        return $this->queries[$this->operator];
    }

    /**
     * @return \mysqli|\PDO
     */
    public function adapter()
    {
        return $this->adapter;
    }

    /**
     * @param string $operator
     * @param $adapter
     * @return array
     */
    public function maintainMutationUnit(string $operator, $adapter): array
    {
        $this->adapter = $adapter;
        return $this->operator($operator)->queryUnit();
    }

    /**
     * @param array $queries
     * @param array $params
     * @return array
     */
    public function mutationUnitOperations(array $queries, array $params)
    {
        $operations = [];
        foreach ($queries as $operation) {
            $operations[] = [
                'statement' => $this->adapter()->prepare($operation),
                'parameters' => $params[$this->operator]
            ];
        }
        return $operations;
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