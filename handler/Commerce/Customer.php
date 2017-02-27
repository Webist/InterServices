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

    public function __construct(CustomerData $customerData, $entityManager)
    {
        $this->data = $customerData;
        $this->entityManager = $entityManager;
    }

    public function handle()
    {
        $repo = $this->entityManager->getRepository(CustomerData::class);
        $data = $repo->find($this->data->getId());

        if($data){
            $this->entityManager->merge($this->data);
        } else {
            $this->entityManager->persist($this->data);
        }

        $this->entityManager->flush();

        return true;
    }
}