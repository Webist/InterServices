<?php


namespace App\Operator;


class Customer implements \App\Contract\Behave\Operator
{
    private $operations = [];

    public function addOperation($key, $operation)
    {
        $this->operations[$key] = $operation;
    }

    public function getOperations()
    {
        return $this->operations;
    }
}