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
        try {
            // Forward route
            $this->matchContext->generateIndexKey();

            $fileName = dirname(dirname(dirname(__DIR__)))
                . self::ROUTES_DATASTORAGE_PATH . '/Routes'
                . '/' . $this->matchContext->indexKey() . '.php';

            if (!file_exists($fileName)) {
                throw new ForwardRouteNotFoundException('Forward route not found');
            } else {
                $this->inputHandler->setRoute(include $fileName);
                return $this->inputHandler->routeArrayMap();
            }

        } catch (ForwardRouteNotFoundException $exception) {

            // Regular route
            $this->matchContext->setRouteType(self::ROUTE_TYPE_ROUTE);
            $this->matchContext->generateIndexKey();

            $fileName = dirname(dirname(dirname(__DIR__)))
                . self::ROUTES_DATASTORAGE_PATH . '/Routes'
                . '/' . $this->matchContext->indexKey() . '.php';

            if (!file_exists($fileName)) {
                throw new NotFoundException('Regular route not found');
            } else {
                $this->inputHandler->setRoute(include $fileName);
                return $this->inputHandler->routeArrayMap();
            }

        } catch (NotFoundException $exception) {

            throw new NotFoundException(sprintf('The requested resource %s was not found on this server.',
                $this->inputHandler->requestUrlPath()));
        }
    }
}