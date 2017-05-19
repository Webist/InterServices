<?php


namespace Delivery;


class MVC
{
    public function __invoke(string $className, string $actionName, array $parameters)
    {
        $controller = new \ReflectionClass($className);

        $object = $controller->newInstance();

        $reflectionMethod = new \ReflectionMethod($object, $actionName);
        return $reflectionMethod->invokeArgs($object, [$parameters]);
    }
}