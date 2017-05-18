<?php


namespace App\Storage;


class Meta
{
    private $route = [];

    public function __construct($route)
    {
        $this->route = $route;
        $this->visitorLog();
    }

    /**
     * A dirty db-logging
     */
    private function visitorLog()
    {
        $databaseService = new \App\Service\Database();

        $operations = $databaseService->maintainMutationMap(
            ['routeId' => $this->route['indexKey'], 'ip' => filter_input(INPUT_SERVER, 'REMOTE_ADDR')]);

        $statement = $databaseService->prepareOperations($operations);
        return $statement->mutate();
    }

    public function route()
    {
        return $this->route;
    }

    public function arrayMap()
    {
        return include 'Routes/' . $this->route['indexKey'] . '.php';
    }
}