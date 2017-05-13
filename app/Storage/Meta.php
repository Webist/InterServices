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
        $databaseService = new \App\Service\Database(new \Connector\Database());
        $databaseService->visitorLogOperations(
            ['routeId' => $this->route['indexKey'], 'ip' => filter_input(INPUT_SERVER, 'REMOTE_ADDR')]);
        $databaseService->execute();
    }

    public function route()
    {
        return $this->route;
    }

    public function modelMetaData()
    {
        return include 'Routes/' . $this->route['indexKey'] . '.php';
    }
}