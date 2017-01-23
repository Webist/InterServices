<?php
/**
 * Info
 * Created: 11/01/2017 17:26
 * User: fkus
 */

namespace Http\Routing;


class RouteHandler extends RouteAbstract
{
    private $routeSelector;
    private $inputHandler;

    public function __construct(\Http\Routing\RouteSelector $routeSelector, \Http\Stream\InputHandler $inputHandler)
    {
        parent::__construct();

        $this->routeSelector = $routeSelector;
        $this->inputHandler = $inputHandler;

        $this->setMatchContext($this->inputHandler->requestMethod(), $this->inputHandler->requestUrlPath(), $this->inputHandler->isAjax());

    }

    public function handle()
    {
        $routes = $this->routeSelector->handle();

        // Forward route
        $this->generateIndexKey();
        if (isset($routes[$this->indexKey])) {
            return $routes[$this->indexKey];
        }

        // Regular route
        $this->matchContext['routeType'] = self::ROUTE_TYPE_ROUTE;
        $this->generateIndexKey();

        if (isset($routes[$this->indexKey])) {
            return $routes[$this->indexKey];
        }

        throw new NotFoundException(sprintf('The requested resource %s was not found on this server.',
            $this->inputHandler->requestUrlPath()));
    }
}