<?php
return [
    'match' =>
        array(
            'routeType' => 0,
            'request_' =>
                array(
                    'REQUEST_URI' => '/customers',
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
    'indexKey' => '7aa37bca37d1814768019721800fd9fb',
    'delivery' => 'MOM',
    'class' => 'Customer',
    'method' => 'renderList',
    'config' => 'Customer',
    'handler' => 'Customer',
    'head' => array(
        'title' => 'Customers List'
    ),
    'body' => array(
        'title' => '<h1>Customers List</h1>'
    ),
];