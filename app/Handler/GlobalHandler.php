<?php
/**
 * Info
 * Created: 21/01/2017 20:00
 * User: fkus
 */

namespace App\Handler;


class GlobalHandler implements \App\Config\GlobalHandler
{
    private $route = [];
    private $services = [];

    public function __construct($route)
    {
        $this->route = $route;

        $this->logVisit();
    }

    /**
     * Access to given (external) service, instantiate an object once only
     * Services are declared in \App\Config\GlobalHandler
     *
     * @example
     * $globalHandler = $this->handler::$global;
     * $mailer = $globalHandler->service($globalHandler::MAILER);
     *
     * @param $serviceName
     * @param null $callback
     * @return mixed
     */
    public function service($serviceName, $callback = null)
    {
        if(!isset($this->services[$serviceName])){

            $reflection = new \ReflectionClass($serviceName);

            if($reflection->hasMethod('__construct')){
                // Closure
                //if(($callback instanceof \Closure)){
                    $object = $reflection->newInstance($callback);
                //}

            } else {
                $object = $reflection->newInstance();
            }
        }
        return $this->services[$serviceName] = $object;
    }

    function logVisit()
    {
        // Micro-service; Non-blocking, db logging

        $routeId = $this->route['indexKey'];
        $ip = filter_input(INPUT_SERVER, 'REMOTE_ADDR');

        $dbLogger = function($pdo) use ($routeId, $ip) {

            $query = "INSERT INTO visits SET route_id = :routeId, ip = :ip";
            $dbh = $pdo->prepare($query);
            return $dbh->execute(
                [':routeId' => $routeId, ':ip' => $ip]
            );
        };

        $db = $this->service(self::DATABASE_SERVICE, $dbLogger);
        $db->handle();
    }
}