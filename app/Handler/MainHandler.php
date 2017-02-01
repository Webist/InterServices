<?php

namespace App\Handler;


class MainHandler extends AbstractMain
{

    function logVisit(array $params)
    {
        // Micro-service; Non-blocking, db logging

        $dbLogger = function($pdo) use ($params) {

            $query = "INSERT INTO visits SET route_id = :routeId, ip = :ip";
            $dbh = $pdo->prepare($query);
            return $dbh->execute(
                [':routeId' => $params['routeId'], ':ip' => $params['ip']]
            );
        };

        $db = $this->service(self::DATABASE, $dbLogger);
        $db->handle();
    }
}