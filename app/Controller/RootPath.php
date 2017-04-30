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
     * Entry point RootPath model page, renders model page, html data
     * @return string
     */
    public function renderModelPage()
    {
        $view = new \View\Model(
            \View\RootPath::modelPage($this->handler->modelPage()),
            $this->handler->main()->modelMetaData()
        );
        return $view->render(false);
    }

    /**
     * Entry point home page post request, adds Home Page Post, exception
     * @throws NotImplementedException
     */
    public function addHomePagePost()
    {
        throw new NotImplementedException(sprintf('%s::%s needs to be implemented!', __CLASS__, __FUNCTION__));
    }

    /**
     * Entry point RootPath email post xhr request, adds Email Post Xhr, confirmation message
     * @return string
     */
    public function addEmailPostXhr()
    {
        $returnValue = $this->handler->emailPostXhr(
            filter_input_array(INPUT_POST), $this->inputHandler->parameter('uuid'));

        return json_encode(
            [
                self::CONFIRMATION_MESSAGE_KEY => $returnValue->state(),
                'state' => ['title' => 'RootPath', 'url' => ''],
                'uuid' => $this->handler->uuid(),
                'data' => [
                    'succeeds' => $returnValue->getSucceedMessages(),
                    'errors' => $returnValue->getFailureErrors()
                ]
            ]
        );
    }
}
