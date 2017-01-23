<?php
/**
 * Info
 * Created: 27/12/2016 09:56
 * User: fkus
 */

namespace Http\Dispatch;


use App\Handler\GlobalHandler;
use Http\Routing\RoutingInterface;

class Dispatcher implements DispatcherInterface, RoutingInterface
{
    private $route;
    private $inputHandler;

    public function __construct(array $route, \Http\Stream\InputHandler $inputHandler)
    {
        $this->route = $route;
        $this->inputHandler = $inputHandler;
    }

    public function handle()
    {
        // A Forward route
        if (isset($this->route[self::FORWARD_DESTINATION_NAME])) {
            ob_start();
            $route = $this->route;
            include $this->route[self::FORWARD_DESTINATION_NAME];
            return ob_get_clean();
        }

        // A Regular route
        $controller = new \ReflectionClass($this->route[self::CLASS_FIELD_NAME]);

        // Machine Object Model, requires __construct, Interface and Handler.
        $handler = null;
        if ('' != ($handlerClass = $this->route[self::CLASS_HANDLER_NAME])) {
            $handler = new $handlerClass([], new GlobalHandler($this->route));
        }
        $object = $controller->newInstance($this->inputHandler, $handler);
        $reflectionMethod = new \ReflectionMethod($object, $this->route[self::CLASS_ACTION_FIELD_NAME]);
        return $reflectionMethod->invokeArgs($object, [$this->inputHandler->parameters()]);
    }
}