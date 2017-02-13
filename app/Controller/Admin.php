<?php

namespace App\Controller;

use App\Exception\NotImplementedException;
use App\Spec\AdminHandler;
use Http\Stream\InputHandler;
use App\Spec\Admin as AdminInterface;

class Admin implements AdminInterface
{
    public function __construct(InputHandler $inputHandler, AdminHandler $handler)
    {

    }

    public function index()
    {
        throw new NotImplementedException('%s::%s needs to be implemented!', __CLASS__, __FUNCTION__);
    }

    public function post()
    {
        throw new NotImplementedException('%s::%s needs to be implemented!', __CLASS__, __FUNCTION__);
    }
}
