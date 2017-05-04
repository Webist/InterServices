<?php

namespace Payment;


class BillingSchedule implements \App\Contract\Behave\React
{
    /**
     * @var BillingScheduleData
     */
    private $data;

    /**
     * @var \App\Service\ORM
     */
    private $orm;

    /**
     * Enables the feature multiple times persisting before flushing.
     * @var bool
     */
    private $persisted = false;

    public function __construct(\App\Contract\Behave\DataObject $dataObject, \App\Service\ORM $orm)
    {
        $this->data = $dataObject;
        $this->orm = $orm;
    }

    public function execute()
    {
        if (!$this->persisted) {
            $this->persist();
        }
        $this->entityManager()->flush();
        return $this->entityManager()->contains($this->data);
    }

    /**
     * @return \Payment\BillingSchedule
     */
    public function persist()
    {
        if (($data = $this->foundData())) {
            $this->data->setCreatedAt($data->getCreatedAt());
            $this->entityManager()->merge($this->data);
        } else {
            $this->entityManager()->persist($this->data);
        }
        $this->persisted = true;
        return $this;
    }

    public function foundData()
    {
        $repo = $this->entityManager()->getRepository(BillingScheduleData::class);
        return $repo->find($this->data->getId());
    }

    private function entityManager()
    {
        return $this->orm->entityManager();
    }
}