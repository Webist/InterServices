<?php

namespace Mail;


class EmailSend
{
    private $data;

    public function __construct(\Mail\EmailData $emailData)
    {
        $this->data = $emailData;
    }

    public function execute()
    {
        return mail(
            $this->data->getReceiver(),
            $this->data->getSubject(),
            $this->data->getMessage(),
            $this->data->getHeaders()
        );
    }
}