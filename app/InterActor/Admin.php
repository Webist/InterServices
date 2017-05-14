<?php

namespace App\InterActor;


class Admin implements \App\Contract\Spec\Admin
{
    /**
     * Holds route, input information and access to generic handler
     * @var \App\Storage\Meta
     */
    private $meta;

    /**
     * Provides instantiation of defined class
     * @var \App\Service\Container
     */
    private $container;

    public function __construct(\App\Storage\Meta $meta, \App\Service\Container $container)
    {
        $this->meta = $meta;
        $this->container = $container;
    }
}
