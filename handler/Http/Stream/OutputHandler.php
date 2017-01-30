<?php

namespace Http\Stream;


class OutputHandler
{
    private $dispatcher;
    private $inputHandler;

    public function __construct(\Http\Dispatch\Dispatcher $dispatcher, InputHandler $inputHandler)
    {
        $this->dispatcher = $dispatcher;
        $this->inputHandler = $inputHandler;
    }

    public function handle(){

        if($this->inputHandler->isAjax()){
            header('Content-Type: application/json');
        }

        echo $this->dispatcher->handle();
    }
}