<?php

return [
    'match' =>
        array(
            'routeType' => 1,
            'request_' =>
                array(
                    'REQUEST_URI' => '/',
                    'REQUEST_METHOD' => 'POST',
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
    'indexKey' => 'a585ac59b104425e42f06fd8adcd7ac0',
    'delivery' => 'MOM',
    'class' => 'RootPath',
    'method' => 'addPost',
    'config' => 'RootPath',
    'handler' => 'RootPath',
    'head' => array(
        'title' => 'Home'
    ),
    'body' => array(
        'title' => '<h1>Home</h1>'
    ),
];