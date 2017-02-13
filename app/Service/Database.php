<?php

namespace App\Service;


class Database extends \App\Spec\Service\Database\Database
{
    private $callback;

    public function __construct($callback)
    {
        $this->callback = $callback;
    }

    public function handle()
    {
        return call_user_func($this->callback, $this->db());
    }
}