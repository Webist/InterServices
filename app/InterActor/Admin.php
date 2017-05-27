<?php

namespace App\InterActor;


class Admin implements \App\Contract\Spec\Admin, \App\Contract\Behave\InterActor
{
    /**
     * Holds route, input information and access to generic handler
     * @var \App\Storage\Meta
     */
    private $meta;

    /**
     * @var App
     */
    private $app;

    /**
     * RootPath constructor.
     * @param \App\Storage\Meta $meta
     * @param App $app
     */
    public function __construct(\App\Storage\Meta $meta, \App\InterActor\App $app)
    {
        $this->meta = $meta;
        $this->app = $app;
    }

    public function meta()
    {
        return $this->meta;
    }

    public function app()
    {
        return $this->app;
    }
}
