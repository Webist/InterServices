<?php

namespace App\Controller;


class RootPath implements \App\Contract\Spec\RootPath
{
    private $inputHandler;
    private $actor;

    public function __construct(\Http\Stream\InputHandler $inputHandler, \App\InterActor\RootPath $actor)
    {
        $this->inputHandler = $inputHandler;
        $this->actor = $actor;
    }

    /**
     * Entry point RootPath page, renders page, html content
     * @return string
     */
    public function renderPage()
    {
        $view = new \View\Model(
            \View\RootPath::page($this->actor->contentArrayMap()),
            $this->actor->meta()->arrayMap()
        );
        return $view->render(false);
    }

    /**
     * Entry point post request, adds RootPath Post, exception
     * @throws \Exceptions\NotImplementedException
     */
    public function addPost()
    {
        throw new \Exceptions\NotImplementedException(sprintf('%s::%s needs to be implemented!', __CLASS__, __FUNCTION__));
    }

    /**
     * Entry point email post xhr request, adds Email Post Xhr, confirmation message
     * @return string
     */
    public function addPostXhrEmail()
    {
        $returnValue = $this->actor->emailArrayMap(filter_input_array(INPUT_POST));

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
