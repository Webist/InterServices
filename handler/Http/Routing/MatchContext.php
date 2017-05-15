<?php

namespace Http\Routing;


use Http\Resolve\ResolverInterface;

class MatchContext implements ResolverInterface, RouteInterface
{
    private $match = [];
    private $indexKey;

    /**
     * Loads template match context
     * RouteAbstract constructor.
     */
    public function __construct()
    {
        $this->match = self::MATCH_CONTEXT;
    }

    public function setMatchContext(string $requestMethod, string $path, bool $isXhr = false)
    {
        $this->match['request_']['REQUEST_METHOD'] = $requestMethod;
        $this->match['request_']['REQUEST_URI'] = $path;
        $this->match['http_']['HTTP_X_REQUESTED_WITH'] = $isXhr;
    }

    public function setDeliveryModel(string $delivery)
    {
        if(!in_array($delivery, self::DELIVERY_MODELS)) {
            throw new \InvalidArgumentException();
        }
        $this->{self::DELIVERY_NAME} = $delivery;
    }

    public function setDestination($destination)
    {
        // Forward route
        if(false === stristr($destination, '@', true)){
            $this->{self::FORWARD_DESTINATION_NAME} = $destination;
            $this->match['routeType'] = self::ROUTE_TYPE_FORWARD;
            $className = str_replace(['_'], [' '], ucfirst(basename($destination, ".php")));
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

        $this->{'head'} = ['title' => $className];
        $this->{'body'} = ['title' => "<h1>{$className}</h1>"];
    }

    public function setXRequestedWith(bool $bool)
    {
        $this->match['http_']['HTTP_X_REQUESTED_WITH'] = $bool;
    }

    public function setRouteType($routeType)
    {
        $this->match['routeType'] = $routeType;
    }

    public function generateIndexKey()
    {
        return $this->indexKey = md5(serialize($this->match));
    }

    public function indexKey()
    {
        return $this->indexKey;
    }
}