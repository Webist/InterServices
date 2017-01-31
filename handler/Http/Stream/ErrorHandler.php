<?php

namespace Http\Stream;


class ErrorHandler
{
    private $exception;
    private $inputHandler;
    public function __construct($exception, InputHandler $inputHandler)
    {
        $this->exception = $exception;
        $this->inputHandler;
    }

    public function handle()
    {

        if ($_SERVER['APPLICATION_ENV'] == 'development') {
            echo $this->exception->getMessage();
        }

        // for instance write to file
        // ...
    }
}