<?php

namespace App\Controller;

use App\Exception\NotImplementedException;

use Http\Stream\InputHandler;
use App\Spec\Admin as AdminInterface;

class Admin implements AdminInterface
{
    public function __construct(InputHandler $inputHandler, \App\Handler\Admin $handler)
    {

    }

    public function post()
    {
        throw new NotImplementedException(sprintf('%s::%s needs to be implemented!', __CLASS__, __FUNCTION__));
    }
}
