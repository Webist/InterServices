<?php
/**
 * Info.
 * User: fkus
 * Date: 26/12/2016
 * Time: 11:50
 */

namespace Http\Routing;


interface RoutingInterface
{
    const METHODS_FIELD_NAME = "methods";
    const PATHS_FIELD_NAME = "path";
    const CLASS_FIELD_NAME = "class";
    const CLASS_ACTION_FIELD_NAME = "method";

    const INTER_FIELD_NAME = "config";
    const HANDLER_FIELD_NAME = "handler";

    const CLASS_HANDLER_NAME = "handler";

    const FORWARD_DESTINATION_NAME = 'filename';

    const ROUTE_NOT_FOUND_MESSAGE = 'The requested resource %s was not found on this server.';
    const ROUTE_INVALID_PARAMETER = 'Route %s contains invalid parameter.';
    const ROUTE_METHOD_NOT_ALLOWED = 'Method %s not allowed';
}