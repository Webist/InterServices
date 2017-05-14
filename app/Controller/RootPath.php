<?php

namespace App\Controller;

use Exceptions\NotImplementedException;
use Http\Stream\InputHandler;

class RootPath implements \App\Contract\Spec\RootPath
{
    private $inputHandler;
    private $actor;

    public function __construct(InputHandler $inputHandler, \App\InterActor\RootPath $actor)
    {
        $this->inputHandler = $inputHandler;
        $this->actor = $actor;
    }

    /**
     * Entry point RootPath model page, renders model page, html data
     * @return string
     */
    public function renderModelPage()
    {
        $view = new \View\Model(
            \View\RootPath::modelPage($this->actor->modelPage()),
            $this->actor->meta()->data()
        );
        return $view->render(false);
    }

    /**
     * Entry point home page post request, adds Home Page Post, exception
     * @throws \Exceptions\NotImplementedException
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
        $returnValue = $this->actor->emailPostXhrData(filter_input_array(INPUT_POST));

        return json_encode(
            [
                self::CONFIRMATION_MESSAGE_KEY => $returnValue->state(),
                'state' => ['title' => 'RootPath', 'url' => ''],
                'uuid' => $returnValue->uuid(),
                'data' => [
                    'succeeds' => $returnValue->getSucceedMessages(),
                    'errors' => $returnValue->getFailureErrors()
                ]
            ]
        );
    }
}
