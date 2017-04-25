<?php

namespace App\Handler;



use App\Spec\ORM;
use Mail\EmailData;
use Mail\EmailSender;

class RootPath implements \App\Spec\Main, ORM
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

    /**
     * @param array $postData
     * @return mixed
     */
    public function postData(array $postData)
    {
        /** @var \App\Service\DoctrineORM $doctrine */
        $doctrine = $this->container->get(self::DOCTRINE, function(){});
        $entityManager = $doctrine->entityManager();

        $message = null;
        // Define which type of command
        if(array_key_exists('email', $postData)
            && array_key_exists('subject', $postData)
            && array_key_exists('message', $postData)) {

            \Assert\Assertion::email($postData['email']);

            // Actor, a role that validates
            $sender = new EmailSender($postData['email']);

            $eMail = new EmailData();
            $eMail->setSender($sender->getEmail());
            $eMail->setReceiver(self::EMAIL_TO);
            $eMail->setMessage("\n" . $postData['message'] ."\r\n");
            $eMail->setSubject($postData['subject']);

            $headers = 'From: '. $sender->getEmail() . "\r\n" .
                'Replay-to: ' . $sender->getEmail() .  "\r\n" .
                'X-Mailer: PHP/' . phpversion();

            $eMail->setHeaders($headers);

            $mailer = function () use ($eMail, $entityManager) {
                $mailer = new \Mail\Mailer($eMail);
                $mailer->handle($entityManager);
            };

            /** @var \App\Service\Mailer $mailerService */
            $mailerService = $this->container->get(self::MAILER, $mailer);
            $message = $mailerService->invoke();

            /** @var \App\Service\Customer $customerService */
            $customerService = $this->container->get(self::CUSTOMER, function () {
            });
            $customerService->createUserProfileFromEmail($postData, $this->main->uuid()->toString());
        }

        return $message;
    }
}
