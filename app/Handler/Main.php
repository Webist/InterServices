<?php

namespace App\Handler;


class Main
{
    private $inputHandler;
    private $mainHandler;

    public function __construct(\Http\Stream\InputHandler $inputHandler, MainHandler $mainHandler)
    {
        $this->inputHandler = $inputHandler;
        $this->mainHandler = $mainHandler;
    }

    public function inputHandler()
    {
        return $this->inputHandler;
    }

    public function mainHandler()
    {
        return $this->mainHandler;
    }

}