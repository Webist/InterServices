<?php

namespace Mail;


class Mailer
{
    private $data;
    private $handler;

    public function __construct(EmailData $emailData, $handler = null)
    {
        $this->data = $emailData;
        $this->handler = $handler;
    }

    public function uuid()
    {
        return $this->data->getHash();
    }

    public function data()
    {
        return $this->data;
    }

    public function execute()
    {
        // When no handler given, then native php mailer
        if ($this->handler === null) {
            return mail(
                $this->data->getReceiver(),
                $this->data->getSubject(),
                $this->data->getMessage(),
                $this->data->getHeaders()
            );
        }

        return $this->handler->execute();
    }
}