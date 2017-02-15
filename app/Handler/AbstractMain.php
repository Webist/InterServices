<?php

namespace App\Handler;


class AbstractMain implements \App\Spec\Main, \App\Spec\MainHandler
{
    private $services = [];

    /**
     * Dynamically instantiate, once only, an object via reflection
     *
     * @example
     * $mailer = $this->handler->service(self::MAILER);
     * $database = $this->handler->service(self::DATABASE, $visitsLoggerQuery);
     *
     * @param $serviceName
     * @param \Closure $callback a callable injection
     * @return object
     */
    public function service($serviceName, \Closure $callback)
    {

        if(!isset($this->services[$serviceName])){

            $reflection = new \ReflectionClass($serviceName);

            if($reflection->hasMethod('__construct')){
                $object = $reflection->newInstance($callback);
            } else {
                $object = $reflection->newInstance();
            }
        }
        return $this->services[$serviceName] = $object;
    }
}