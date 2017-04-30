<?php

namespace Mail;


class Mailer
{
    private $command;
    private $handler;

    public function __construct(EmailCommand $emailCommand, $handler = null)
    {
        $this->command = $emailCommand;
        $this->handler = $handler;
    }

    public function handle()
    {
        // When no handler given, then native php mailer
        if ($this->handler === null) {
            return mail(
                $this->command->getReceiver(),
                $this->command->getSubject(),
                $this->command->getMessage(),
                $this->command->getHeaders()
            );
        }

        return $this->handler->handle();
    }
}