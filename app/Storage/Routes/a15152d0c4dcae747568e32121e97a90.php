<?php

return [
    'match' =>
        array(
            'routeType' => 1,
            'request_' =>
                array(
                    'REQUEST_URI' => '/test',
                    'REQUEST_METHOD' => 'GET',
                    'REQUEST_SCHEME' => NULL,
                ),
            'http_' =>
                array(
                    'HTTP_X_REQUESTED_WITH' => false,
                    'HTTP_HOST' => NULL,
                    'HTTP_USER_AGENT' => NULL,
                    'HTTP_ACCEPT' => NULL,
                    'HTTP_ACCEPT_LANGUAGE' => NULL,
                ),
            'server_' =>
                array(
                    'SERVER_NAME' => NULL,
                    'SERVER_ADDR' => NULL,
                    'SERVER_PORT' => NULL,
                    'SERVER_SOFTWARE' => NULL,
                ),
            'remote_' =>
                array(
                    'REMOTE_ADDR' => NULL,
                ),
            'placeholder' =>
                array(
                    'pattern' =>
                        array(),
                    'default' =>
                        array(),
                ),
        ),
    'indexKey' => 'a15152d0c4dcae747568e32121e97a90',
    'delivery' => 'MVC',
    'class' => 'Test',
    'method' => 'renderTestString',
    'config' => 'Test',
    'handler' => 'Test',
    'head' => array(
        'title' => 'Test'
    ),
    'body' => array(
        'title' => '<h1>Test</h1>'
    ),
];