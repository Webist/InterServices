<?php

namespace App\Handler;


use App\Spec\Database;

class MainHandler extends Service implements Database
{
    private $route = [];

    public function __construct(array $route)
    {
        $this->route = $route;

        $this->logVisit([
            'routeId' => $this->route['indexKey'], 'ip' => filter_input(INPUT_SERVER, 'REMOTE_ADDR')
        ]);
    }

    private function logVisit(array $params)
    {
        // Non-blocking, db logging
        $visitsLoggerQuery = function($pdo) use ($params) {

            $query = "INSERT INTO visits SET route_id = :routeId, ip = :ip";
            $dbh = $pdo->prepare($query);
            return $dbh->execute(
                [':routeId' => $params['routeId'], ':ip' => $params['ip']]
            );
        };

        /** @var \App\Service\Database $db */
        $db = $this->service(self::DATABASE, $visitsLoggerQuery);
        $db->handle( dirname(__DIR__) . self::DATABASE_LOGS_CREDENTIALS_FILE);
    }
}