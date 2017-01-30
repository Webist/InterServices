<?php

namespace Http\Resolve;


use Http\Routing\RoutingInterface;

class Resolver implements ResolverInterface, RoutingInterface
{
    private $routeHandler;

    public function __construct(\Http\Routing\RouteHandler $routeHandler)
    {
        $this->routeHandler = $routeHandler;
    }

    public function handle()
    {
        $route = $this->routeHandler->handle();

        if(isset($route[self::FORWARD_DESTINATION_NAME])){
            return $route;
        }

        $route[self::CLASS_FIELD_NAME] = self::CONTROLLER_PATH_NAME . $route[self::CLASS_FIELD_NAME];
        $route[self::CLASS_ACTION_FIELD_NAME] = $route[self::CLASS_ACTION_FIELD_NAME];
        $route[self::INTER_FIELD_NAME] = self::INTER_PATH_NAME . $route[self::INTER_FIELD_NAME];
        $route[self::HANDLER_FIELD_NAME] = self::HANDLER_PATH_NAME . $route[self::HANDLER_FIELD_NAME];

        return $route;
    }
}