<?php

namespace Http\Stream;

use Exception;

class ErrorHandler
{
    /**
     * @var Exception
     */
    private $exception;

    /**
     * @var InputHandler
     */
    private $inputHandler;

    /**
     * ErrorHandler constructor.
     *
     * @param Exception $exception
     * @param InputHandler $inputHandler
     */
    public function __construct(Exception $exception, InputHandler $inputHandler)
    {
        $this->exception = $exception;
        $this->inputHandler;
    }

    /**
     * Handle error
     */
    public function handle()
    {
        if (!empty($_SERVER['APPLICATION_ENV']) && $_SERVER['APPLICATION_ENV'] == 'development') {
            echo $this->exception->getMessage();
        }

        // for instance write to file
        // ...
    }
}