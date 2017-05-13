<?php


namespace App\Contract\Action;


class Mailer implements \App\Contract\Spec\Main
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function assertEmailPostXhrData()
    {
        \Assert\Assertion::notEmpty($this->data);
        \Assert\Assertion::email($this->data['email']);

        \Assert\Assertion::keyExists($this->data, 'subject');
        \Assert\Assertion::keyExists($this->data, 'message');

        $this->data['email_to'] = self::EMAIL_TO;

        return $this->data;
    }
}