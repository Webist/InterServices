<?php
/**
 * Info
 * Created: 20/01/2017 14:06
 * User: fkus
 */

namespace App\Service;


class Database extends \App\Config\Service\Database
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