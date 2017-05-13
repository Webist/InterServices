<?php

namespace Http\Routing;


interface RoutingInterface
{
    const ROUTES_DATASTORAGE_PATH = "/app/Storage";
    const ROUTES_DATASTORAGE_FILE = "RoutesIndex.php";

    const ROUTE_NOT_FOUND_MESSAGE = 'The requested resource %s was not found on this server.';
    const ROUTE_INVALID_PARAMETER = 'Route %s contains invalid parameter.';
    const ROUTE_METHOD_NOT_ALLOWED = 'Method %s not allowed';
}