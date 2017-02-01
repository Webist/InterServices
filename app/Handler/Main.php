<?php

namespace App\Handler;


class Main extends AbstractMain
{
    private $route = [];
    private $handler;

    public function __construct($route, MainHandler $handler)
    {
        $this->route = $route;
        $this->handler = $handler;

        $args = [
          'routeId' => $this->route['indexKey'], 'ip' => filter_input(INPUT_SERVER, 'REMOTE_ADDR')
        ];
        $this->handler->logVisit($args);
    }
}