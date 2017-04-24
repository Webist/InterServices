<?php

namespace Mail;


class Mailer
{
    private $data;
    private $entityManager;

    public function __construct(EmailData $emailData, \Doctrine\ORM\EntityManager $entityManager)
    {
        $this->data = $emailData;
        $this->entityManager = $entityManager;
    }

    public function handle()
    {
        try {
            // when duplicate, then throw an error.
            $entityManager = $this->entityManager;
             $entityManager->persist($this->data);
             $entityManager->flush();

            if(mail(
                $this->data->getReceiver(),
                $this->data->getSubject(),
                $this->data->getMessage(),
                $this->data->getHeaders()
            )) {
                return 'The mail was successfully accepted for delivery';
            }
        } catch (\Exception $exception) {

            if(strpos($exception->getMessage(), '1062 Duplicate entry') !== false){
                return 'Message was already sent.';
            }
            return $exception->getMessage();
        }
    }
}