<?php


namespace Delivery;

use App\Handler\Main;

class MOM
{
    public function __invoke($className, $classHandlerName, $classActionName, $route, $inputHandler)
    {
        // A Regular route
        $controller = new \ReflectionClass($className);

        // Machine Object Model, requires __construct, Interface and Handler.
        $handler = null;
        if ('' != ($classHandlerName)) {
            $container = new \Service\Container();
            $handler = new $classHandlerName(new Main($route, $container));
        }
        $object = $controller->newInstance($inputHandler, $handler);
        $reflectionMethod = new \ReflectionMethod($object, $classActionName);
        return $reflectionMethod->invokeArgs($object, [$inputHandler->parameters()]);
    }
}