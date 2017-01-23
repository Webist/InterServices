<?php
/**
 * User: fkus
 * Date: 26/12/2016
 * Time: 17:23
 */

namespace Http\Resolve;


interface ResolverInterface
{
    const CONTROLLER_PATH_NAME = "App\\Controller\\";
    const INTER_PATH_NAME = "App\\Config\\";
    const HANDLER_PATH_NAME = "App\\Handler\\";

    function __construct($route);
    function handle();
}