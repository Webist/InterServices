<?php


namespace App\Container;

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
class Service
{
    /**
     * Holds already instantiated Service objects. A simple DIC.
     * @var array
     */
    private $services = [];

    /**
     * Instantiates a Service object, a framework, and remembers to initiate once only
     * @param $serviceObject
     * @param \App\Contract\Behave\Statement|null $statement
     * @param \App\Contract\Behave\Operator|null $operator
     * @return mixed
     */
    public function get($serviceObject, \App\Contract\Behave\Statement $statement = null, \App\Contract\Behave\Operator $operator = null)
    {
        if (!isset($this->services[$serviceObject])) {
            $reflection = new \ReflectionClass($serviceObject);
            if ($reflection->hasMethod('__construct')) {
                $this->services[$serviceObject] = $reflection->newInstance($statement, $operator);
            } else {
                // A service might to choose implement statements via methods
                $this->services[$serviceObject] = $reflection->newInstance();
            }
        }
        return $this->services[$serviceObject];
    }
}