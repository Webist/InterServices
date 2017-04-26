<?php

namespace App\Controller;

use App\Exception\NotImplementedException;
use Http\Stream\InputHandler;

class RootPath implements \App\Spec\RootPath
{
    private $inputHandler;
    private $handler;

    public function __construct(InputHandler $inputHandler, \App\Handler\RootPath $handler)
    {
        $this->inputHandler = $inputHandler;
        $this->handler = $handler;
    }

    /**
     * @return string
     */
    public function get()
    {
        $view = new \View\Model(
            \View\RootPath::get($this->handler->get()),
            $this->handler->main()->pageMetaData()
        );
        return $view->render(false);
    }

    public function post()
    {
        throw new NotImplementedException(sprintf('%s::%s needs to be implemented!', __CLASS__, __FUNCTION__));
    }

    public function getXhr()
    {
        throw new NotImplementedException(sprintf('%s::%s needs to be implemented!', __CLASS__, __FUNCTION__));
    }

    public function postXhr()
    {
        return json_encode(
            [
                self::RESPONSE_MESSAGE_KEY => $this->handler->postXhr(
                    filter_input_array(INPUT_POST),
                    $this->inputHandler->parameter('uuid'))
            ]
        );
    }
}
