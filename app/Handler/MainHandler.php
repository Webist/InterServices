<?php

namespace App\Handler;


class MainHandler extends AbstractMain
{

    function logVisit(array $params)
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
        $db->handle( dirname(getcwd()) . self::DATABASE_LOGS_CREDENTIALS_FILE);
    }
}