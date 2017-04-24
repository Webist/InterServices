<?php

namespace Http\Routing;


class RouteHandler implements RoutingInterface, RouteInterface
{
    private $inputHandler;

    private $matchContext;

    public function __construct(\Http\Stream\InputHandler $inputHandler, MatchContext $matchContext)
    {
        $this->inputHandler = $inputHandler;
        $this->matchContext = $matchContext;

        $this->matchContext->setMatchContext(
            $this->inputHandler->requestMethod(),
            $this->inputHandler->requestUrlPath(),
            $this->inputHandler->isAjax());
    }

    public function handle()
    {
        $routes = include dirname(getcwd()) . self::ROUTES_DATASTORAGE_PATH . DIRECTORY_SEPARATOR . self::ROUTES_DATASTORAGE_FILE;

        // Forward route
        $this->matchContext->generateIndexKey();
        if (isset($routes[$this->matchContext->indexKey()])) {
            return $routes[$this->matchContext->indexKey()];
        }

        // Regular route
        $this->matchContext->setRouteType(self::ROUTE_TYPE_ROUTE);
        $this->matchContext->generateIndexKey();

        if (isset($routes[$this->matchContext->indexKey()])) {
            return $routes[$this->matchContext->indexKey()];
        }

        throw new NotFoundException(sprintf('The requested resource %s was not found on this server.',
            $this->inputHandler->requestUrlPath()));
    }
}