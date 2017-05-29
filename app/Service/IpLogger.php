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
     * @param $operator
     * @return $this
     */
    private function operator($operator)
    {
        $this->operator = $operator;
        return $this;
    }

    private function queryUnit(): bool
    {
        $this->queries[$this->operator];
        return true;
    }

    /**
     * @param string $operator
     * @return bool
     */
    public function maintainMutation(string $operator): bool
    {
        $this->operator($operator)->queryUnit();
        return true;
    }

    /**
     * @param array $params
     * @param $adapter \mysqli|\PDO
     * @return array
     */
    public function mutationOperations(array $params, $adapter): array
    {
        $operations = [];
        foreach ($this->queries[$this->operator] as $operation) {
            $operations[] = [
                'statement' => $adapter->prepare($operation),
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