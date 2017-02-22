<?php

namespace App\Handler;


class Admin
{
    /**
     * Holds route, input information and access to generic handler
     * @var Main
     */
    private $main;

    /**
     * Provides instantiation of defined class
     * @var Service
     */
    private $service;

    /**
     * Unique id
     * @var
     */
    private static $uuid;

    /**
     * Holds operations (in a global state) to make consumable (e.g. a callback via service)
     * @var array
     */
    private static $operations = [];

    public function __construct(Main $main, Service $service)
    {
        $this->main = $main;
        $this->service = $service;
    }

    /**
     *
     * @param string $serviceName
     * @param null $callable
     * @return object
     */
    public function service(string $serviceName, $callable = null)
    {
        // As of PHP 7.1.x we cannot assign anonymous function in arguments, fix this by if statement.
        if(!$callable){
            $callable = function () {};
        }

        return $this->service->service($serviceName, $callable);
    }

    public function uuid()
    {
        if(self::$uuid === null){
            $uuid4 = \Ramsey\Uuid\Uuid::uuid4();
            self::$uuid = $uuid4->toString();
        }
        return self::$uuid;
    }

    /**
     * Builds mutation operations
     * @param array $postData
     */
    final public static function buildOperations(array $postData, $uuid)
    {
        throw new NotImplementedException('%s::%s needs to be implemented!', __CLASS__, __FUNCTION__);
    }

    final public static function getOperations()
    {
        return self::$operations;
    }
}
