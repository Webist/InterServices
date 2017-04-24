<?php

namespace Payment;


class Pay
{
    /**
     * @var PaymentPreferenceData
     */
    private $data;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    public function __construct(PaymentPreferenceData $paymentPreferenceData, \Doctrine\ORM\EntityManager $entityManager)
    {
        $this->data = $paymentPreferenceData;
        $this->entityManager = $entityManager;
    }

    public function data()
    {
        return $this->data;
    }

    public function handle()
    {
        $entityManager = $this->entityManager;

        $repo = $entityManager->getRepository(PaymentPreferenceData::class);
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