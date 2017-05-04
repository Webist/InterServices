<?php


namespace App\Operator;


class Database
{
    private $statements = [];
    private $params = [];

    public function addStatement($key, $statement)
    {
        $this->statements[$key] = $statement;
    }

    public function getStatements()
    {
        return $this->statements;
    }

    public function addParams($key, $params)
    {
        $this->params[$key] = $params;
    }

    public function getParams($key)
    {
        return $this->params[$key];
    }
}