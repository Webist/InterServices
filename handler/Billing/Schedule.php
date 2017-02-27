<?php

namespace Billing;


class Schedule
{
    /**
     * @var ScheduleData
     */
    private $data;
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    public function __construct(ScheduleData $scheduleData, $entityManager)
    {
        $this->data = $scheduleData;
        $this->entityManager = $entityManager;
    }

    public function handle()
    {
        $repo = $this->entityManager->getRepository(ScheduleData::class);
        $data = $repo->find($this->data->getId());

        if($data){
            $this->entityManager->merge($this->data);
        } else {
            $this->entityManager->persist($this->data);
        }

        $this->entityManager->flush();
    }
}