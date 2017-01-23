<?php
/**
 * Info
 * Created: 13/01/2017 23:12
 * User: fkus
 */

namespace App\Handler;


class Admin implements \App\Config\AdminHandler
{
    private $input;
    public static $global;

    public function __construct($input, GlobalHandler $global)
    {
        $this->input = $input;
        self::$global = $global;
    }
}
