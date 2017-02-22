<?php

namespace Notify;


class BillingSchedule
{
    /**
     * @var BillingScheduleData
     */
    private $data;
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    public function __construct(BillingScheduleData $billingScheduleData, $entityManager)
    {
        $this->data = $billingScheduleData;
        $this->entityManager = $entityManager;
    }

    public function handle()
    {
        $repo = $this->entityManager->getRepository(BillingScheduleData::class);
        $data = $repo->find($this->data->getId());

        if($data){
            $this->entityManager->merge($this->data);
        } else {
            $this->entityManager->persist($this->data);
        }

        $this->entityManager->flush();
    }
}