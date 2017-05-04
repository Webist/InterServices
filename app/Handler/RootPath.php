<?php

namespace App\Handler;


class RootPath implements \App\Contract\Spec\RootPath
{
    /**
     * Holds route, input information and access to generic handler
     * @var \App\Meta\Main
     */
    private $main;

    /**
     * @var \App\Container\Service
     */
    private $container;

    /**
     * RootPath constructor.
     * @param \App\Meta\Main $main
     * @param \App\Container\Service $container
     */
    public function __construct(\App\Meta\Main $main, \App\Container\Service $container)
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
     *
     * @param array $postData
     * @param null $uuid
     * @return \App\ReturnValue\Email
     */
    public function emailPostXhrData(array $postData, $uuid = null)
    {
        \Assert\Assertion::notEmpty($postData);
        \Assert\Assertion::email($postData['email']);

        \Assert\Assertion::keyExists($postData, 'subject');
        \Assert\Assertion::keyExists($postData, 'message');

        try {
            $this->createCustomerFromEmailPost($postData);
        } catch (\Exception $exception) {
            // do nothing
        }

        /** @var \App\Service\Mailer $mailerService */
        $mailerService = $this->container->get(self::MAILER);
        $mailerService->emailPostXhrOperations(new \App\Event\MailerStatement($postData));
        return $mailerService->dispatch();
    }

    /**
     * Handler RootPath create customer from email post, dispatches customer command, customer data transfer
     * @param array $postData
     * @return \App\ReturnValue\Customer
     */
    private function createCustomerFromEmailPost(array $postData)
    {
        /** @var \App\Service\Customer $customerService */
        $customerService = $this->container->get(self::CUSTOMER,
            new \App\Source\CustomerStatement($postData),
            new \App\Operator\Customer()
        );

        $customerService->emailPostXhrDataOperations(new \App\Source\CustomerStatement($postData), $postData['email']);
        return $customerService->mutate();
    }

    public function main()
    {
        return $this->main;
    }
}
