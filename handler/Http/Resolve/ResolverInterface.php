<?php

namespace Http\Resolve;


interface ResolverInterface
{
    const CONTROLLER_PATH_NAME = "App\\Controller\\";
    const INTER_PATH_NAME = "App\\Main\\";
    const HANDLER_PATH_NAME = "App\\Handler\\";

    function handle();
}