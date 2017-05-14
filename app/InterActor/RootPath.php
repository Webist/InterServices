<?php

namespace App\InterActor;


class RootPath implements \App\Contract\Spec\RootPath
{
    /**
     * Holds route, input information and access to generic handler
     * @var \App\Storage\Meta
     */
    private $meta;

    /**
     * @var \App\Container\Service
     */
    private $container;

    /**
     * RootPath constructor.
     * @param \App\Storage\Meta $meta
     * @param \App\Container\Service $container
     */
    public function __construct(\App\Storage\Meta $meta, \App\Container\Service $container)
    {
        $this->meta = $meta;
        $this->container = $container;
    }

    public function modelPage()
    {
        return [];
    }

    /**
     * InterActor RootPath email post xhr data, dispatches email command, email data transfer
     * @param array $postData
     * @return $this
     */
    public function emailPostXhrData(array $postData)
    {
        $postData['email_to'] = self::EMAIL_TO;

        /** @var \App\Service\Mailer $mailerService */
        $mailerService = $this->container->get(self::MAILER);
        // Query
        $mailerService->maintainLifeCyclePostXhrData($postData);
        // Command
        $mailerService->setLifeCyclePostXhrData();
        return $mailerService->dispatch();
    }

    /**
     * @return \App\Storage\Meta
     */
    public function meta()
    {
        return $this->meta;
    }
}
