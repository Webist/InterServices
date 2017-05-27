<?php


namespace App\InterActor;

class App implements \App\Contract\Spec\Main
{

    /**
     * Holds already instantiated Service objects. A simple DIC.
     * @var array
     */
    private $services = [];

    /**
     * @param $handlerFieldName
     * @param $route
     * @return null
     */
    public function controllerInterActor($handlerFieldName, $route)
    {
        $interActor = null;
        $meta = new \App\Storage\Meta($route);
        if (!empty($handlerFieldName)) {
            $classHandlerName = self::INTERACTOR_NAMESPACE . $handlerFieldName;
            $interActor = new $classHandlerName($meta, $this);
        }

        // Extra feature, log visits
        try {
            // Read config file with credentials
            /** @var \App\Service\File $fileService */
            $fileService = $this->get(self::FILE);
            $credentials = $fileService->maintainUnit(dirname(__DIR__) . self::CREDENTIALS_FILE)->get();

            // Get the database adapter with connection
            /** @var \App\Service\Adapter $adapterService */
            $adapterService = $this->get(self::DB_ADAPTER);
            $adapter = $adapterService->maintainUnit($credentials)->get(\App\Contract\Spec\Main::DATABASE_LOGS);

            // Insert into data store
            /** @var \App\Service\IpLogger $ipLoggerService */
            $ipLoggerService = $this->get(self::IP_LOGGER);
            $queries = $ipLoggerService->maintainMutationUnit($ipLoggerService::OPERATOR_VISITOR_LOG, $adapter);

            $params = [
                $ipLoggerService::OPERATOR_VISITOR_LOG => [
                    'routeId' => $route['indexKey'],
                    'ip' => filter_input(INPUT_SERVER, 'REMOTE_ADDR')]
            ];
            $operations = $ipLoggerService->mutationUnitOperations($queries, $params);
            $ipLoggerService->mutate($operations);

        } catch (\Throwable $throwable) {
            //
        }

        return $interActor;
    }

    /**
     * @param $classFieldName
     * @return string
     */
    public function controllerClassName($classFieldName)
    {
        return self::CONTROLLER_NAMESPACE . $classFieldName;
    }

    /**
     * @param $interfaceFieldName
     * @return string
     */
    public function controllerInterFaceName($interfaceFieldName)
    {
        return self::SPEC_NAMESPACE . $interfaceFieldName;
    }

    /**
     * Instantiates a Service object, a framework, and remembers to initiate once only
     *
     * A simple Dependency Injection Container
     * Here is explained why better than Static methods or Singleton
     * https://www.imarc.com/blog/dependency-injection
     *
     * https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-11-container-meta.md
     * https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-11-container.md
     *
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