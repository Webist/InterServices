<?php

namespace App\Service;

class Customer
{
    /**
     * Holds the callback as it was defined when this service was reflected
     * @example function () { return $this->handler::getOperations();}
     *
     * @var \Closure
     */
    private $callback;

    public function __construct(\Closure $callback)
    {
        $this->callback = $callback;
    }

    public function handle()
    {
       $operations = call_user_func($this->callback);

        foreach($operations as $operation) {
            $operation->handle();
        }
    }
}
