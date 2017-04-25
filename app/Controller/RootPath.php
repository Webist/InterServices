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
        /** @var \App\Handler\RootPath $handler */
        $this->handler = $handler;
    }

    /**
     * @return string
     */
    public function get()
    {
        return $this->handler->get();
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
        \Assert\Assertion::notEmpty($postData = filter_input_array(INPUT_POST));

        return json_encode([self::RESPONSE_MESSAGE_KEY => $this->handler->postXhr($postData)]);
    }
}
