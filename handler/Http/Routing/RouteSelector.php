<?php

namespace Http\Routing;


class RouteSelector
{
    private $filename;
    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    public function handle()
    {
       return include $this->filename;
    }
}