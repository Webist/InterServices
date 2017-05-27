<?php


namespace Delivery;


class MOM
{
    public function __invoke(string $className, $interActor, string $classActionName, \Http\Stream\InputHandler $inputHandler)
    {
        $controller = new \ReflectionClass($className);
        $object = $controller->newInstance($inputHandler, $interActor);
        $reflectionMethod = new \ReflectionMethod($object, $classActionName);
        return $reflectionMethod->invokeArgs($object, [$inputHandler->parameters()]);
    }
}