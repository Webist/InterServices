<?php

namespace App\Handler;


class AbstractMain implements \App\Spec\Main, \App\Spec\MainHandler
{
    private $services = [];

    /**
     * Access to given (external) service, instantiate an object once only
     * Services are declared in \App\Spec\Main
     *
     * @example
     * $mailer = $this->handler->service(self::MAILER);
     *
     * @param $serviceName
     * @param null $callback
     * @return mixed
     */
    public function service($serviceName, $callback = null)
    {
        if(!isset($this->services[$serviceName])){

            $reflection = new \ReflectionClass($serviceName);

            if($reflection->hasMethod('__construct')){
                // Closure
                //if(($callback instanceof \Closure)){
                $object = $reflection->newInstance($callback);
                //}

            } else {
                $object = $reflection->newInstance();
            }
        }
        return $this->services[$serviceName] = $object;
    }
}