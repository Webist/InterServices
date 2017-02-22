<?php

namespace Payment;


class CreditCard
{
    /**
     * @var CreditCardData
     */
    private $data;
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    public function __construct(CreditCardData $creditCardData, $entityManager)
    {
        $this->data = $creditCardData;
        $this->entityManager = $entityManager;
    }

    public function handle()
    {
        $repo = $this->entityManager->getRepository(CreditCardData::class);
        $data = $repo->find($this->data->getId());

        if($data){
            $this->entityManager->merge($this->data);
        } else {
            $this->entityManager->persist($this->data);
        }

        $this->entityManager->flush();
    }
}