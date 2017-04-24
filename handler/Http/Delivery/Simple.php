<?php


namespace Delivery;


class Simple
{
    public function __invoke($route, $destination)
    {
        ob_start();
        include $destination;
        return ob_get_clean();
    }
}