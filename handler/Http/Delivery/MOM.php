<?php


namespace Delivery;


class MOM
{
    public function __invoke($className, $classHandlerName, $classActionName, $route, \Http\Stream\InputHandler $inputHandler)
    {
        // A Regular route
        $controller = new \ReflectionClass($className);

        // Machine Object Model, requires __construct, Interface and InterActor.
        $handler = null;
        if ('' != ($classHandlerName)) {
            $handler = new $classHandlerName(
                new \App\Storage\Meta($route),
                new \App\Service\Container()
            );
        }
        $object = $controller->newInstance($inputHandler, $handler);
        $reflectionMethod = new \ReflectionMethod($object, $classActionName);
        return $reflectionMethod->invokeArgs($object, [$inputHandler->parameters()]);
    }
}