<?php


namespace Statement;


class Operation
{
    private $operator = '';
    /** In context mutate, when a new record needed to be created */
    const PERSIST = 'persist';
    /** In context mutate, when a record should be updated  */
    const MERGE = 'merge';

    /**
     * @var \Statement\DataObject
     */
    private $dataObject;


    /**
     * Enables the feature multiple persists before flushing.
     * @var bool
     */
    private $persisted = false;

    /**
     * @var \Connector\ORM
     */
    private $orm;

    public function __construct(\Statement\DataObject $dataObject, $operator, \Connector\ORM $orm)
    {
        $this->dataObject = $dataObject;
        $this->operator = $operator;
        $this->orm = $orm;
    }

    public function data()
    {
        return $this->dataObject;
    }

    /**
     * @return $this
     */
    public function persist()
    {
        if ($this->operator == self::PERSIST) {
            $this->orm->entityManager()->persist($this->dataObject);
        }

        if ($this->operator == self::MERGE) {

            if ($this->dataObject->getId()) {
                $this->dataObject = $this->orm->entityManager()->getRepository(get_class($this->data()))->find($this->dataObject->getId());
                $this->dataObject->setCreatedAt($this->dataObject->getCreatedAt());
            }
            $this->orm->entityManager()->merge($this->dataObject);
        }

        $this->persisted = true;
        return $this;
    }

    /**
     * @param bool $persistOnly
     * @return bool
     */
    public function execute($persistOnly = false)
    {
        if (!$persistOnly && !$this->persisted) {
            $this->persist();
        }
        $this->orm->entityManager()->flush();
        return $this->orm->entityManager()->contains($this->dataObject);
    }
}