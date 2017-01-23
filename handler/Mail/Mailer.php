<?php
/**
 * Info
 * Created: 04/01/2017 13:40
 * User: fkus
 */

namespace Mail;


class Mailer
{
    private $data;
    public function setData($data)
    {
        $this->data = $data;
    }

    public function send()
    {
        $headers = 'From: ' . $this->data['email'] . "\r\n" .
            'Reply-To: ' . $this->data['email'] . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        $message = 'Name: '. $this->data['name'] . 'Phone: ' . $this->data['phone'] . 'Message: '. $this->data['message'];
        return mail(
            $this->data['to'],
            $this->data['subject'],
            $message,
            $headers);
    }
}