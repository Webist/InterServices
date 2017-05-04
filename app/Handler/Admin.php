<?php

namespace App\Handler;


class Admin
{
    /**
     * Holds route, input information and access to generic handler
     * @var \App\Meta\Main
     */
    private $main;

    /**
     * Provides instantiation of defined class
     * @var \App\Container\Service
     */
    private $container;

    public function __construct(\App\Meta\Main $main, \App\Container\Service $container)
    {
        $this->main = $main;
        $this->container = $container;
    }
}
