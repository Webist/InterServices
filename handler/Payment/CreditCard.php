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

    public function __construct(CreditCardData $creditCardData, \Doctrine\ORM\EntityManager $entityManager)
    {
        $this->data = $creditCardData;
        $this->entityManager = $entityManager;
    }

    public function data()
    {
        return $this->data;
    }

    public function handle()
    {
        $entityManager = $this->entityManager;

        $repo = $entityManager->getRepository(CreditCardData::class);
        $data = $repo->find($this->data->getId());

        if($data){
            $entityManager->merge($this->data);
        } else {
            $entityManager->persist($this->data);
        }

        $entityManager->flush();
        return $entityManager->contains($this->data);
    }
}