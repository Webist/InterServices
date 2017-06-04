<?php

namespace Http\Resolve;


use Http\Routing\RoutingInterface;

class Resolver implements ResolverInterface, RoutingInterface
{
    private $routeHandler;

    private $interActor;

    public function __construct(\Http\Routing\RouteHandler $routeHandler, \App\Service\App $interActor)
    {
        $this->routeHandler = $routeHandler;
        $this->interActor = $interActor;
    }

    public function handle()
    {
        $route = $this->routeHandler->handle();

        $route[self::HANDLER_FIELD_NAME] = $this->interActor->controllerInterActor($route[self::HANDLER_FIELD_NAME], $route);

        if($route[self::DELIVERY_NAME] == self::DELIVERY_MODEL_SIMPLE) {
            return $route;
        }

        $route[self::CLASS_FIELD_NAME] = $this->interActor->controllerClassName($route[self::CLASS_FIELD_NAME]);
        $route[self::INTER_FIELD_NAME] = $this->interActor->controllerInterFaceName($route[self::INTER_FIELD_NAME]);

        return $route;
    }
}