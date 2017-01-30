<?php

namespace App\Handler;


class Admin implements \App\Main\AdminHandler
{
    private $input;
    public static $global;

    public function __construct($input, Main $global)
    {
        $this->input = $input;
        self::$global = $global;
    }
}
