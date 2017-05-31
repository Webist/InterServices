<?php


namespace Statement;


class Predicate
{
    private $fieldName;
    private $operator;
    private $values = [];

    public function __construct($fieldName, $operator, array $values)
    {
        $this->fieldName = $fieldName;
        $this->operator = $operator;
        $this->values = $values;
    }

    public function fieldName()
    {
        return $this->fieldName;
    }

    public function operator()
    {
        return $this->operator;
    }

    public function values()
    {
        return $this->values;
    }
}