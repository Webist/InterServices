<?php

namespace App\Handler;



use App\Spec\ORM;
use Mail\EmailData;
use Mail\EmailSender;
use Mail\Mailer;

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

    public function postData(array $postData)
    {
        /** @var \App\Service\DoctrineORM $doctrine */
        $doctrine = $this->container->get(self::DOCTRINE, function(){});
        $entityManager = $doctrine->entityManager();

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

            $mailer = new Mailer($eMail, $entityManager);
            $message = $mailer->handle();

            $this->createUserProfile($postData, $entityManager);

            return $message;
        }
    }

    public function createUserProfile($postData, $entityManager)
    {
        $repo = $entityManager->getRepository(\Account\UserProfileData::class);
        /** @var \Account\UserProfileData $userProfileData */
        $userProfileData = $repo->findOneBy(['email' => $postData['email']]);

        // no-user matched, then create new user
        if(!$userProfileData) {
            $uuid = $this->main->uuid()->toString();

            $userProfileData = new \Account\UserProfileData($uuid);
            $userProfileData->setEmail($postData['email']);
            $userProfileData->setPhone($postData['phone']);
            $userProfileData->setFullName('');
            $userProfileData->setGender(0);
            $userProfileData->setAddress('');
            $userProfileData->setCity('');
            $userProfileData->setCountry('');
            $userProfileData->setRemarks('');

            $userProfile = new \Account\UserProfile($userProfileData, $entityManager);
            $userProfile->handle();

            $userData = new \Account\UserData($uuid);
            $userData->setName($postData['name']);
            $userData->setPasswd(1);

            $user = new \Account\User($userData, $entityManager);
            return $user->handle();
        }
    }

}
