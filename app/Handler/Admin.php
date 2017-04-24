<?php

namespace App\Handler;


class Admin
{
    /**
     * Holds route, input information and access to generic handler
     * @var Main
     */
    private $main;

    /**
     * Provides instantiation of defined class
     * @var \Service\Container
     */
    private $container;

    public function __construct(Main $main)
    {
        $this->main = $main;
        $this->container = $this->main->container();
    }
}
