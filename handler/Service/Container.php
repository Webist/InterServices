<?php


namespace Service;

/**
 * A simple Dependency Injection Container
 * Here is explained why better than Static methods or Singleton
 * https://www.imarc.com/blog/dependency-injection
 *
 * https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-11-container-meta.md
 * https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-11-container.md
 *
 *
 * Class Service
 * @package App\Handler
 */
class Container
{
    /**
     * Holds already instantiated objects. A simple DIC.
     * @var array
     */
    private $services = [];

    /**
     * Provides instantiating a Service object once only with encapsulation by Closure
     * Closure will be injected as first parameter when the target class has construct.
     *
     * @param $serviceObject string representation of the object to instantiate
     * @param \Closure $callable
     * @return object
     */
    public function get($serviceObject, \Closure $callable)
    {
        if(!isset($this->services[$serviceObject])){
            $reflection = new \ReflectionClass($serviceObject);
            // Directly to callback Closures can be injected into the construct of class
            if($reflection->hasMethod('__construct')){
                $this->services[$serviceObject] = $reflection->newInstance($callable);
            } else {
                $this->services[$serviceObject] = $reflection->newInstance();
            }
        }
        return $this->services[$serviceObject];
    }
}