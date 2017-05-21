<?php


namespace App\Storage;



class Meta
{
    private $route = [];

    public function __construct(array $route)
    {
        $this->route = $route;

        if (!isset($this->route['indexKey'])) {
            throw new \OutOfBoundsException(sprintf('`indexKey` for is not set in `%s`', var_export($this->route, true)));
        }

        $this->visitorLog();
    }

    /**
     * A dirty db-logging
     */
    private function visitorLog()
    {
        $databaseService = new \App\Service\Database();

        $queries = $databaseService->maintainMutationMap(
            ['routeId' => $this->route['indexKey'], 'ip' => filter_input(INPUT_SERVER, 'REMOTE_ADDR')]);
        $operations = $databaseService->mutationMapOperations($queries);
        return $databaseService->mutate($operations);
    }

    public function route()
    {
        return $this->route;
    }

    public function routeArrayMap()
    {
        $fileName = __DIR__ . '/Routes/' . $this->route['indexKey'] . '.php';
        if (!file_exists($fileName)) {
            throw new \LogicException(sprintf('File `%s` not found', $fileName));
        } else {
            return include $fileName;
        }
    }
}