<?php

namespace Commerce;


class Customer
{
    /**
     * @var CustomerData
     */
    private $data;

    /**
     * Enables the feature multiple times persisting before flushing.
     * @var bool
     */
    private $persisted = false;

    /**
     * @var \App\Service\ORM
     */
    private $orm;

    public function __construct(\App\Contract\Behave\DataObject $dataObject, \App\Service\ORM $orm)
    {
        $this->data = $dataObject;
        $this->orm = $orm;
    }

    public function data()
    {
        return $this->data;
    }

    /**
     * Hydrates data from data store
     * @usage UPDATE
     */
    public function hydrate()
    {
        return $this->data = $this->foundData();
    }

    public function foundData()
    {
        if ($this->data->getId()) {
            $repo = $this->orm->entityManager()->getRepository(CustomerData::class);
            return $repo->find($this->data->getId());
        }
        return $this->data;
    }

    public function execute()
    {
        if (!$this->persisted) {
            $this->persist();
        }
        $this->orm->entityManager()->flush();
        return $this->orm->entityManager()->contains($this->data);
    }

    /**
     * @return $this
     */
    public function persist()
    {
        if (!empty($data = $this->foundData())) {
            $this->data->setCreatedAt($data->getCreatedAt());
            $this->orm->entityManager()->merge($this->data);
        } else {
            $this->orm->entityManager()->persist($this->data);
        }
        $this->persisted = true;
        return $this;
    }
}