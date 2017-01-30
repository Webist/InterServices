<?php

namespace Http\Routing;


abstract class RouteAbstract implements RouteInterface, RoutingInterface
{
    protected $matchContext = [];
    protected $indexKey;

    /**
     * Loads template match context
     * RouteAbstract constructor.
     */
    protected function __construct()
    {
        $this->matchContext = self::MATCH_CONTEXT;
    }

    protected function setMatchContext(string $requestMethod, string $path, bool $isXhr = false)
    {
        $this->matchContext['request_']['REQUEST_METHOD'] = $requestMethod;
        $this->matchContext['request_']['REQUEST_URI'] = $path;
        $this->matchContext['http_']['HTTP_X_REQUESTED_WITH'] = $isXhr;
    }

    protected function setDestination($destination)
    {
        // Forward route
        if(false === stristr($destination, '@', true)){
            $this->{self::FORWARD_DESTINATION_NAME} = $destination;
            $this->matchContext['routeType'] = self::ROUTE_TYPE_FORWARD;
        } else {
            // Regular route
            $className = stristr($destination, '@', true);
            $this->{self::CLASS_FIELD_NAME} = $className;

            $this->{self::CLASS_ACTION_FIELD_NAME} = ltrim(stristr(stristr($destination, ':', true), '@'), '@');
            if($this->{self::CLASS_ACTION_FIELD_NAME} == ''){
                $this->{self::CLASS_ACTION_FIELD_NAME} = substr(strrchr($destination, "@"), 1);
            }

            $this->{self::INTER_FIELD_NAME} = ltrim(stristr(stristr($destination, '=>', true), ':'), ':');
            if($this->{self::INTER_FIELD_NAME} == ''){
                $this->{self::INTER_FIELD_NAME} = $className;
            }

            $this->{self::HANDLER_FIELD_NAME} = ltrim(substr(strrchr($destination, "=>"), 1), '>');
            if($this->{self::HANDLER_FIELD_NAME} == ''){
                $this->{self::HANDLER_FIELD_NAME} = $className;
            }
        }
    }

    protected function generateIndexKey()
    {
        return $this->indexKey = md5(serialize($this->matchContext));
    }
}