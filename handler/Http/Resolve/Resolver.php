<?php
/**
 * User: fkus
 * Date: 26/12/2016
 * Time: 17:24
 */

namespace Http\Resolve;


use Http\Routing\RoutingInterface;

class Resolver implements ResolverInterface, RoutingInterface
{
    private $route;

    public function __construct($route)
    {
        $this->route = $route;
    }

    public function handle()
    {
        if(isset($this->route[self::FORWARD_DESTINATION_NAME])){
            return $this->route;
        }

        $this->route[self::CLASS_FIELD_NAME] = self::CONTROLLER_PATH_NAME . $this->route[self::CLASS_FIELD_NAME];
        $this->route[self::CLASS_ACTION_FIELD_NAME] = $this->route[self::CLASS_ACTION_FIELD_NAME];
        $this->route[self::INTER_FIELD_NAME] = self::INTER_PATH_NAME . $this->route[self::INTER_FIELD_NAME];
        $this->route[self::HANDLER_FIELD_NAME] = self::HANDLER_PATH_NAME . $this->route[self::HANDLER_FIELD_NAME];

        return $this->route;
    }
}