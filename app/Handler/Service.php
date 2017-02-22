<?php


namespace App\Handler;


class Service
{
    /**
     * Holds already instantiated objects. A simple DIC.
     * @var array
     */
    private $services = [];

    /**
     * Dynamically instantiate, once only, an object via reflection
     *
     * @example
     * $mailer = $this->handler->service(self::MAILER);
     * $database = $this->handler->service(self::DATABASE, $visitsLoggerQuery);
     *
     * @param $serviceName string representation of the object to instantiate
     * @param \Closure $callable a callable injection as handler
     * @return object
     */
    public function service($serviceName, \Closure $callable)
    {
        if(!isset($this->services[$serviceName])){

            $reflection = new \ReflectionClass($serviceName);

            // Directly to callback Closures can be injected into the construct of class
            if($reflection->hasMethod('__construct')){
                $object = $reflection->newInstance($callable);
            } else {
                $object = $reflection->newInstance();
            }
        }
        return $this->services[$serviceName] = $object;
    }
}