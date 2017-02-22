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

    public function __construct(PaymentPreferenceData $paymentPreferenceData, $entityManager)
    {
        $this->data = $paymentPreferenceData;
        $this->entityManager = $entityManager;
    }

    public function handle()
    {
        $repo = $this->entityManager->getRepository(PaymentPreferenceData::class);
        $data = $repo->find($this->data->getId());

        if($data){
            $this->entityManager->merge($this->data);
        } else {
            $this->entityManager->persist($this->data);
        }

        $this->entityManager->flush();
    }
}