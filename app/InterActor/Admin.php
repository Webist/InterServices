<?php

namespace App\InterActor;


use App\Service\App;

class Admin implements \App\Contract\Spec\Admin, \App\Contract\Behave\InterActor
{
    /**
     * @var App
     */
    private $app;

    /**
     * Admin constructor.
     * @param App $app
     */
    public function __construct(\App\Service\App $app)
    {
        $this->app = $app;
    }

    public function app()
    {
        return $this->app;
    }
}
