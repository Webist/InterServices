<?php

namespace App\Controller;

use App\Main\AdminHandler;
use Http\Stream\InputHandler;

class Admin implements \App\Main\Admin
{
    public function __construct(InputHandler $inputHandler, AdminHandler $handler)
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
