<?php

namespace App\Handler;


class RootPath implements \App\Contract\Spec\RootPath
{
    /**
     * Holds route, input information and access to generic handler
     * @var \App\Storage\Meta
     */
    private $main;

    /**
     * @var \App\Container\Service
     */
    private $container;

    /**
     * RootPath constructor.
     * @param \App\Storage\Meta $main
     * @param \App\Container\Service $container
     */
    public function __construct(\App\Storage\Meta $main, \App\Container\Service $container)
    {
        $this->main = $main;
        $this->container = $container;
    }

    public function modelPage()
    {
        return [];
    }

    /**
     * Handler RootPath email post xhr data, dispatches email command, email data transfer
     * @param array $postData
     * @return $this
     */
    public function emailPostXhrData(array $postData)
    {
        \Assert\Assertion::notEmpty($postData);
        \Assert\Assertion::email($postData['email']);

        \Assert\Assertion::keyExists($postData, 'subject');
        \Assert\Assertion::keyExists($postData, 'message');

        $postData['email_to'] = self::EMAIL_TO;

        /** @var \App\Service\Mailer $mailerService */
        $mailerService = $this->container->get(self::MAILER);
        $mailerService->setLifeCyclePostXhrData($postData);
        return $mailerService->dispatch();
    }

    /**
     * @return \App\Storage\Meta
     */
    public function main()
    {
        return $this->main;
    }
}
