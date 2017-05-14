<?php


namespace App\Service;

/**
 * @deprecated By strict applying MOM there is no need for re-instantiation of a Service object http://webist.nl/articles/machine-object-model.md
 *
 * A simple Dependency Injection Container
 * Here is explained why better than Static methods or Singleton
 * https://www.imarc.com/blog/dependency-injection
 *
 * https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-11-container-meta.md
 * https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-11-container.md
 *
 *
 * Class Service
 * @package App\InterActor
 */
class Container
{
    /**
     * Holds already instantiated Service objects. A simple DIC.
     * @var array
     */
    private $services = [];

    /**
     * Instantiates a Service object, a framework, and remembers to initiate once only
     * @param $serviceObject
     * @return mixed
     */
    public function get($serviceObject)
    {
        if (!isset($this->services[$serviceObject])) {
            $reflection = new \ReflectionClass($serviceObject);
            $this->services[$serviceObject] = $reflection->newInstance();
        }
        return $this->services[$serviceObject];
    }
}