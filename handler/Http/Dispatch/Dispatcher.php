<?php

namespace Http\Dispatch;


use App\Handler\Main;
use App\Handler\MainHandler;
use Http\Routing\RoutingInterface;

class Dispatcher implements DispatcherInterface, RoutingInterface
{
    private $resolver;
    private $inputHandler;

    public function __construct(\Http\Resolve\Resolver $resolver, \Http\Stream\InputHandler $inputHandler)
    {
        $this->resolver = $resolver;
        $this->inputHandler = $inputHandler;
    }

    public function handle()
    {
        $route = $this->resolver->handle();

        // A Forward route
        if (isset($route[self::FORWARD_DESTINATION_NAME])) {
            ob_start();
            include $route[self::FORWARD_DESTINATION_NAME];
            return ob_get_clean();
        }

        // A Regular route
        $controller = new \ReflectionClass($route[self::CLASS_FIELD_NAME]);

        // Machine Object Model, requires __construct, Interface and Handler.
        $handler = null;
        if ('' != ($handlerClass = $route[self::CLASS_HANDLER_NAME])) {
            $handler = new $handlerClass([], new Main($route, new MainHandler()));
        }
        $object = $controller->newInstance($this->inputHandler, $handler);
        $reflectionMethod = new \ReflectionMethod($object, $route[self::CLASS_ACTION_FIELD_NAME]);
        return $reflectionMethod->invokeArgs($object, [$this->inputHandler->parameters()]);
    }
}