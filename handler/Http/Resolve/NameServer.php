<?php


namespace Http\Resolve;

/**
 * Translates names to internal protocol address.
 *
 * Class NameServer
 * @package Http\Resolve
 */
class NameServer
{
    private const CONTROLLER_PATH_NAME = "App\\Controller\\";
    private const INTER_PATH_NAME = "App\\Spec\\";
    private const HANDLER_PATH_NAME = "App\\Handler\\";

    public function getClassName($classFieldName)
    {
        return self::CONTROLLER_PATH_NAME . $classFieldName;
    }

    public function getInterFaceName($interfaceFieldName)
    {
        return self::INTER_PATH_NAME . $interfaceFieldName;
    }

    public function getHandlerName($handlerFieldName)
    {
        return self::HANDLER_PATH_NAME . $handlerFieldName;
    }
}