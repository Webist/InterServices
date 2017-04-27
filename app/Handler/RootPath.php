<?php

namespace App\Handler;



class RootPath implements \App\Spec\Main
{
    /**
     * Holds route, input information and access to generic handler
     * @var Main
     */
    private $main;

    /**
     * Provides instantiation of defined class
     * @var \Service\Container
     */
    private $container;

    public function __construct(Main $main)
    {
        $this->main = $main;
        $this->container = $this->main->container();
    }

    public function main()
    {
        return $this->main;
    }

    public function container()
    {
        return $this->main->container();
    }

    public function homePage()
    {
        return [];
    }

    /**
     * @param array $postData
     * @return mixed
     */
    public function postXhr(array $postData)
    {
        \Assert\Assertion::notEmpty($postData);
        \Assert\Assertion::email($postData['email']);

        $message = '';
        // Define which type of command
        if(array_key_exists('email', $postData)
            && array_key_exists('subject', $postData)
            && array_key_exists('message', $postData)) {

            /** @var \App\Service\Mailer $mailerService */
            $mailerService = $this->container->get(self::MAILER, function() {});
            $message = $mailerService->handle($postData);

            $customerEvent = new \App\Event\UserProfile($this->container());
            $customerEvent->postXhrOperations($postData, $this->main->uuid()->toString());
        }
        return $message;
    }
}
