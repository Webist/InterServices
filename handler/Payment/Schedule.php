<?php

namespace Payment;


use App\Spec\ORM;

class Schedule implements ORM
{
    /**
     * @var ScheduleData
     */
    private $data;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    public function __construct(BillingScheduleData $scheduleData, \Doctrine\ORM\EntityManager $entityManager)
    {
        $this->data = $scheduleData;
        $this->entityManager = $entityManager;
    }

    public function data()
    {
        return $this->data;
    }

    public function handle()
    {
        $entityManager = $this->entityManager;

        $repo = $entityManager->getRepository(BillingScheduleData::class);
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