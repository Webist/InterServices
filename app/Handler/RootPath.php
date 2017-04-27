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
     * @param null $uuid
     * @return string
     */
    public function postXhr(array $postData, $uuid = null)
    {
        \Assert\Assertion::notEmpty($postData);
        \Assert\Assertion::email($postData['email']);

        \Assert\Assertion::keyExists($postData, 'subject');
        \Assert\Assertion::keyExists($postData, 'message');

        /** @var \App\Service\Mailer $mailerService */
        $mailerService = $this->container->get(self::MAILER, function () {
        });
        $message = $mailerService->handle($postData);
        try {
            $this->createUserFromEmailPost($postData);
        } catch (\Exception $exception) {
            //
        }

        return $message;
    }

    /**
     * Creates user from given email postData
     * @param array $postData
     */
    private function createUserFromEmailPost(array $postData)
    {
        $userProfileCommand = new \App\Source\UserProfileCommand($this->container());
        $operations = $userProfileCommand->postXhrOperations($postData, $this->main->uuid()->toString());

        /** @var \App\Service\Customer $customerService */
        $customerService = $this->container()->get(self::CUSTOMER, function () {});
        $customerService->mutate($operations);
    }
}
