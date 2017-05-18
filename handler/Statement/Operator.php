<?php


namespace Statement;


class Operator
{

    /**
     * @var \App\Contract\Behave\DataObject
     */
    private $dataObject;

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
        $this->dataObject = $dataObject;
        $this->orm = $orm;
    }

    /**
     * Hydrates data from data store
     * @usage UPDATE
     */
    public function hydrate()
    {
        return $this->dataObject = $this->foundData();
    }

    public function foundData()
    {
        if ($this->dataObject->getId()) {
            $repo = $this->orm->entityManager()->getRepository(get_class($this->data()));
            return $repo->find($this->dataObject->getId());
        }
        return $this->dataObject;
    }

    public function data()
    {
        return $this->dataObject;
    }

    public function execute($persistOnly = false)
    {
        if (!$persistOnly && !$this->persisted) {
            $this->persist();
        }
        $this->orm->entityManager()->flush();
        return $this->orm->entityManager()->contains($this->dataObject);
    }

    /**
     * @return $this
     */
    public function persist()
    {
        if (!empty($data = $this->foundData())) {
            $this->dataObject->setCreatedAt($data->getCreatedAt());
            $this->orm->entityManager()->merge($this->dataObject);
        } else {
            $this->orm->entityManager()->persist($this->dataObject);
        }
        $this->persisted = true;
        return $this;
    }
}