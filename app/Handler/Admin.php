<?php

namespace App\Handler;


class Admin implements \App\Spec\AdminHandler
{
    private $input;
    public static $main;

    public function __construct($input, Main $main)
    {
        $this->input = $input;
        self::$main = $main;
    }
}
