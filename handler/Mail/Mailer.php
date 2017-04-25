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

    public function handle(\Doctrine\ORM\EntityManager $entityManager)
    {
        try {
            // when duplicate, then throw an error.
            $entityManager->persist($this->data);
            $entityManager->flush();

            // When no handler given, then native php mailer
            if ($this->handler === null) {
                if (mail(
                    $this->data->getReceiver(),
                    $this->data->getSubject(),
                    $this->data->getMessage(),
                    $this->data->getHeaders()
                )) {
                    return 'The mail was successfully accepted for delivery';
                }
            }

        } catch (\Exception $exception) {

            if (strpos($exception->getMessage(), '1062 Duplicate entry') !== false) {
                return 'Message was already sent.';
            }
            return $exception->getMessage();
        }
    }
}