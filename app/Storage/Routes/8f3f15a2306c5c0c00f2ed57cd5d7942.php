<?php

return [
    'match' =>
        array(
            'routeType' => 1,
            'request_' =>
                array(
                    'REQUEST_URI' => '/admin',
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
    'indexKey' => '8f3f15a2306c5c0c00f2ed57cd5d7942',
    'delivery' => 'MOM',
    'class' => 'Admin',
    'method' => 'renderForm',
    'config' => 'Admin',
    'handler' => 'Admin',
    'head' => array(
        'title' => 'Admin'
    ),
    'body' => array(
        'title' => '<h1>Admin</h1>'
    ),
];