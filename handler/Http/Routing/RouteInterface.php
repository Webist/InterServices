<?php
/**
 * Info
 * Created: 11/01/2017 21:13
 * User: fkus
 */

namespace Http\Routing;


interface RouteInterface
{
    const ROUTE_TYPE_FORWARD = 0;
    const ROUTE_TYPE_ROUTE = 1;

    const MATCH_CONTEXT = [
        'routeType' => self::ROUTE_TYPE_FORWARD,
        'request_' => [
            'REQUEST_URI' => '/',
            'REQUEST_METHOD' => null,
            'REQUEST_SCHEME' => null,
        ],
        'http_' => [
            'HTTP_X_REQUESTED_WITH' => false,
            'HTTP_HOST' => null,
            'HTTP_USER_AGENT' => null,
            'HTTP_ACCEPT' => null,
            'HTTP_ACCEPT_LANGUAGE' => null,
        ],
        'server_' => [
            'SERVER_NAME' => null,
            'SERVER_ADDR' => null,
            'SERVER_PORT' => null,
            'SERVER_SOFTWARE' => null,
        ],
        'remote_' => [
            'REMOTE_ADDR' => null,
        ],
        'placeholder' => [
            // pattern examples 'page' => "\d+", 'locale' => "en|fr"
            'pattern' => [],
            // default examples 'page' => 7, 'locale' => 'en'
            'default' => []
        ],
    ];
}