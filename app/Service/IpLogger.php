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
    /**
     * @var \mysqli|\PDO
     */
    private $adapter;

    private $operations = [];

    private $operator;
    const OPERATOR_VISITOR_LOG = 'log visits';

    public function __construct($adapter)
    {
        $this->adapter = $adapter;
    }

    private function operator($operator)
    {
        $this->operator = $operator;
        return $this;
    }

    private function queryUnit()
    {
        if ($this->operator == self::OPERATOR_VISITOR_LOG) {
            return [
                self::OPERATOR_VISITOR_LOG => "INSERT INTO visits SET route_id = :routeId, ip = :ip"
            ];
        }
        return [];
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
     * @return array
     */
    public function maintainMutationUnit(string $operator): array
    {
        return $this->operator($operator)->queryUnit();
    }

    /**
     * @param array $queries
     * @param array $params
     * @return array
     */
    public function mutationUnitOperations(array $queries, array $params)
    {
        foreach ($queries as $operator => $operation) {
            $this->operations[] = [
                'statement' => $this->adapter()->prepare($operation),
                'parameters' => $params[$operator]
            ];
        }
        return $this->operations;
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