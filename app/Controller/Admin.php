<?php

namespace App\Controller;

use Http\Stream\InputHandler;

class Admin implements \App\Spec\Admin
{
    public function __construct(InputHandler $inputHandler, \App\Handler\Admin $handler)
    {
        throw new \App\Exception\Admin('This ' . __CLASS__ .'::'.__FUNCTION__.' is empty yet.');
    }

    public function index()
    {
        throw new \App\Exception\Admin('This ' . __CLASS__ .'::'.__FUNCTION__.' is empty yet.');
    }

    public function post()
    {
        throw new \App\Exception\Admin('This ' . __CLASS__ .'::'.__FUNCTION__.' is empty yet.');
    }
}
