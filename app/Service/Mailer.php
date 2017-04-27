<?php


namespace App\Service;


class Mailer implements \App\Spec\Main
{
    /**
     * Operations holding callable
     *
     * @var \Closure
     */
    private $callback;

    public function __construct(\Closure $callback)
    {
        $this->callback = $callback;
    }

    public function invoke()
    {
        return call_user_func($this->callback);
    }

    public function handle($postData)
    {
        // Actor, a role that validates
        $sender = new \Mail\EmailSender($postData['email']);

        $eMail = new \Mail\EmailData();
        $eMail->setSender($sender->getEmail());
        $eMail->setReceiver(self::EMAIL_TO);
        $eMail->setMessage("\n" . $postData['message'] . "\r\n");
        $eMail->setSubject($postData['subject']);

        $headers = 'From: ' . $sender->getEmail() . "\r\n" .
            'Replay-to: ' . $sender->getEmail() . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        $eMail->setHeaders($headers);

        /** @var \App\Service\DoctrineORM $doctrine */
        $doctrine = new DoctrineORM();
        $entityManager = $doctrine->entityManager();

        $mailer = new \Mail\Mailer($eMail);
        return $mailer->handle($entityManager);

    }
}