<?php

namespace App\Controller;

use Exceptions\NotImplementedException;

use Http\Stream\InputHandler;

class Admin implements \App\Contract\Spec\Admin
{
    public function __construct(InputHandler $inputHandler, \App\InterActor\Admin $actor)
    {

    }

    /**
     * Entry point form request, renders Form, exception
     * @throws \Exceptions\NotImplementedException
     */
    public function renderForm()
    {
        throw new NotImplementedException(sprintf('%s::%s needs to be implemented!', __CLASS__, __FUNCTION__));
    }

}
