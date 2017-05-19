<?php

namespace Http\Stream;

use Exception;

class ErrorHandler
{
    /**
     * @var Exception
     */
    private $throwable;

    /**
     * @var InputHandler
     */
    private $inputHandler;

    /**
     * ErrorHandler constructor.
     * @param \Throwable $throwable http://php.net/manual/en/language.errors.php7.php
     * @param InputHandler $inputHandler
     */
    public function __construct(\Throwable $throwable, InputHandler $inputHandler)
    {
        $this->throwable = $throwable;
        $this->inputHandler;
    }

    /**
     * Handle throwable
     * @param null $traceString
     */
    public function handle($traceString = null)
    {
        if (!empty($_SERVER['APPLICATION_ENV']) && $_SERVER['APPLICATION_ENV'] == 'development') {
            printf('<pre>%s</pre>', $this->throwable->getMessage());
            if ($traceString) {
                printf('<pre>%s</pre>', $this->throwable->getTraceAsString());
            }
        }

        // for example write to a file ...
    }
}