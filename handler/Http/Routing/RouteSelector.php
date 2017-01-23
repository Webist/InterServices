<?php
/**
 * Info
 * Created: 20/01/2017 00:00
 * User: fkus
 */

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