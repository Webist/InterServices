<?php

namespace App\Handler;


class RootPath implements \App\Spec\RootPath
{
    /**
     * Holds route, input information and access to generic handler
     * @var Main
     */
    private $main;

    private $uuid;

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

    public function uuid($id = null)
    {
        if(!empty($id)){
            $this->uuid = $id;
        }

        if($this->uuid === null) {
            $this->uuid = $this->main()->uuid()->toString();
        }
        return $this->uuid;
    }

    public function modelPage()
    {
        return [];
    }

    /**
     * Handler RootPath email post xhr, dispatches email command, email data transfer
     *
     * @param array $postData
     * @param null $uuid
     * @return \App\Service\EmailReturnValue
     */
    public function emailPostXhr(array $postData, $uuid = null)
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

        $spamFilter = new \Mail\EmailSpamFilter($postData['email']);
        $email = $spamFilter->getEmail();

        $emailCommand = new \Mail\EmailCommand(
            [
                'email' => $email,
                'receiver' => self::EMAIL_TO,
                'message' => "\n" . $postData['message'] . "\r\n",
                'subject' => $postData['subject'],
                'headers' => 'From: ' . $email . "\r\n" .
                    'Replay-to: ' . $email . "\r\n" .
                    'X-Mailer: PHP/' . phpversion()
            ]
        );
        // use md5 as uuid response
        $this->uuid($emailCommand->getHash());

        /** @var \App\Service\Mailer $mailerService */
        $mailerService = $this->container->get(self::MAILER, function () {
        });
        return $mailerService->dispatch($emailCommand);
    }

    /**
     * Handler RootPath create customer from email post, dispatches customer command, customer data transfer
     * @param array $postData
     * @return \App\Service\CustomerReturnValue
     */
    private function createCustomerFromEmailPost(array $postData)
    {
        /** @var \App\Service\ORM $orm */
        $orm = $this->container()->get(self::ORM, function () {
        });

        $customerCommand = new \App\Source\CustomerCommand($postData, $orm->entityManager());
        $operations = $customerCommand->emailPostXhrOperations($this->main->uuid()->toString());

        /** @var \App\Service\Customer $customerService */
        $customerService = $this->container()->get(self::CUSTOMER, function () {});
        return $customerService->dispatch($operations);
    }
}
