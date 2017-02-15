<?php

namespace App\Handler;


class AbstractHandler
{
    private $input;
    private $main;

    public function __construct($input, Main $main)
    {
        $this->input = $input;
        $this->main = $main;
    }

    /**
     * Gateway to object instantiation method
     *
     * @param string $class
     * @param \Closure|null $callable
     * @return object
     */
    public function service(string $class, \Closure $callable = null)
    {
        // As of PHP 7.1.x we cannot assign anonymous function in arguments, fix this by if statement.
        if(!$callable){
            $callable = function () {};
        }
        return $this->main->service($class, $callable);
    }


}