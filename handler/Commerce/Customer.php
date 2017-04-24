<?php

namespace Commerce;

class Customer
{
    /**
     * @var CustomerData
     */
    private $data;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    public function __construct(CustomerData $customerData, \Doctrine\ORM\EntityManager $entityManager)
    {
        $this->data = $customerData;
        $this->entityManager = $entityManager;
    }

    public function data()
    {
        return $this->data;
    }

    public function handle()
    {
        $entityManager = $this->entityManager;

        $repo = $entityManager->getRepository(CustomerData::class);
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