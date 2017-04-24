<?php

namespace Http\Resolve;


use Http\Routing\RoutingInterface;

class Resolver implements ResolverInterface, RoutingInterface
{
    private $routeHandler;

    private $nameServer;

    public function __construct(\Http\Routing\RouteHandler $routeHandler, NameServer $nameServer)
    {
        $this->routeHandler = $routeHandler;
        $this->nameServer = $nameServer;
    }

    public function handle()
    {
        $route = $this->routeHandler->handle();

        if($route[self::DELIVERY_NAME] == self::DELIVERY_MODEL_SIMPLE) {
            return $route;
        }

        $route[self::CLASS_FIELD_NAME] = $this->nameServer->getClassName($route[self::CLASS_FIELD_NAME]);
        $route[self::CLASS_ACTION_FIELD_NAME] = $route[self::CLASS_ACTION_FIELD_NAME];
        $route[self::INTER_FIELD_NAME] = $this->nameServer->getInterfaceName($route[self::INTER_FIELD_NAME]);
        $route[self::HANDLER_FIELD_NAME] = $this->nameServer->getHandlerName($route[self::HANDLER_FIELD_NAME]);

        return $route;
    }
}