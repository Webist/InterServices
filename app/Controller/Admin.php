<?php

namespace App\Controller;

use App\Exception\NotImplementedException;

use Http\Stream\InputHandler;

class Admin implements \App\Contract\Spec\Admin
{
    public function __construct(InputHandler $inputHandler, \App\Handler\Admin $handler)
    {

    }

    /**
     * Entry point form request, renders Form, exception
     * @throws NotImplementedException
     */
    public function renderForm()
    {
        throw new NotImplementedException(sprintf('%s::%s needs to be implemented!', __CLASS__, __FUNCTION__));
    }

}
