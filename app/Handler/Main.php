<?php

namespace App\Handler;


use App\Spec\Database;

class Main implements Database, \App\Spec\Main
{
    private $route = [];

    private $container;

    private $uuid;

    public function __construct($route, \Service\Container $container)
    {
        $this->route = $route;
        $this->container = $container;

        $this->visitorLog([
            'routeId' => $this->route['indexKey'], 'ip' => filter_input(INPUT_SERVER, 'REMOTE_ADDR')
        ]);
    }

    /**
     * A dirty db-logging
     *
     * Handler Main visitor log, invokes databaseService, transfer query
     * @param array $params
     * @return mixed
     */
    private function visitorLog(array $params)
    {
        $visitorLogCommand = function (\PDO $pdo) use ($params) {

            $query = "INSERT INTO visits SET route_id = :routeId, ip = :ip";
            $dbh = $pdo->prepare($query);
            return $dbh->execute(
                [':routeId' => $params['routeId'], ':ip' => $params['ip']]
            );
        };

        /** @var \App\Service\Database $databaseService */
        $databaseService = $this->container->get(self::DATABASE, $visitorLogCommand);
        return $databaseService->invoke(dirname(__DIR__) . self::DATABASE_LOGS_CREDENTIALS_FILE);
    }

    public function route()
    {
        return $this->route;
    }

    public function container()
    {
        return $this->container;
    }

    /**
     * Gets a version 4 UUID
     *
     * @anecdote Intent of uuid is to enable a distributed environment, like micro-services,
     * without significant central coordination.
     *
     * @anecdote There's generally two reason to use UUIDs
     * You do not want a database (or some other authority) to centrally control the identity of records.
     * There's a chance that multiple components may independently generate a non-unique identifier.
     *
     * @return \Ramsey\Uuid\UuidInterface
     */
    public function uuid()
    {
        if ($this->uuid === null) {
            $this->uuid = \Ramsey\Uuid\Uuid::uuid4();
        }
        return $this->uuid;
    }

    /**
     * Model meta data, includes file storage by using route['indexKey'], php array
     * @return array
     */
    public function modelMetaData()
    {
        return include dirname(dirname(__FILE__)) . '/DataStorage/' . $this->route['indexKey'] . '.php';
    }
}