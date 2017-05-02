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
     * @var \App\Service\ORM
     */
    private $orm;

    /**
     *
     * @var \App\Service\Customer
     */
    private $service;

    /**
     * Customer constructor.
     * @param Main $main
     */
    public function __construct(Main $main)
    {
        $this->main = $main;

        $this->orm = $this->main->container()->get(\App\Service\ORM::class, function () {
        });
        $this->service = $this->main->container()->get(self::ROOTPATH, function () {
        });
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
     * @return \App\Service\EmailReturnValue
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
        $mailerService = $this->main->container()->get(self::MAILER, function () {
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
        $customerCommand = new \App\Source\CustomerOperation($postData);
        $operations = $customerCommand->emailPostXhrOperations($this->main->uuid()->toString(), $this->orm);

        /** @var \App\Service\Customer $customerService */
        $customerService = $this->main->container()->get(self::CUSTOMER, function () {
        });
        return $customerService->dispatch($operations);
    }

    public function uuid($id = null)
    {
        if (!empty($id)) {
            $this->uuid = $id;
        }

        if ($this->uuid === null) {
            $this->uuid = $this->main()->uuid()->toString();
        }
        return $this->uuid;
    }

    public function main()
    {
        return $this->main;
    }
}
