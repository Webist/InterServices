<?php


namespace App\Event;


use App\Contract\Behave\Statement;
use App\Contract\Spec\Main;

class MailerStatement implements Statement, Main
{
    private $mailData;

    public function __construct(array $mailData)
    {
        $this->mailData = $mailData;
    }

    /**
     * @param null $uuid
     * @param $service \App\Service\Mailer
     */
    public function emailPostXhrReacts($uuid = null, $service)
    {
        $spamFilter = new \Mail\EmailSpamFilter($this->mailData['email']);
        $email = $spamFilter->getEmail();

        $emailData = new \Mail\EmailData(
            [
                'email' => $email,
                'receiver' => self::EMAIL_TO,
                'message' => "\n" . $this->mailData['message'] . "\r\n",
                'subject' => $this->mailData['subject'],
                'headers' => 'From: ' . $email . "\r\n" .
                    'Replay-to: ' . $email . "\r\n" .
                    'X-Mailer: PHP/' . phpversion()
            ]
        );

        $mailer = new \Mail\Mailer($emailData);

        $service->applyReact(get_class($mailer), $mailer);
    }
}