<?php


namespace Statement;


class Operator
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

    public function __construct(\Statement\DataObject $dataObject, $operator)
    {
        $this->dataObject = $dataObject;
        $this->operator = $operator;
    }

    private function orm()
    {
        if ($this->orm === null) {
            $this->orm = new \Connector\ORM();
        }
        return $this->orm;
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
            $this->orm()->entityManager()->persist($this->dataObject);
        }

        if ($this->operator == self::MERGE) {

            if ($this->dataObject->getId()) {
                $dataObject = $this->orm()->entityManager()->getRepository(get_class($this->data()))->find($this->dataObject->getId());
                if ($dataObject) {
                    $this->dataObject->setCreatedAt($dataObject->getCreatedAt());
                    $this->orm()->entityManager()->merge($this->dataObject);
                } else {
                    $this->operator = self::PERSIST;
                    $this->orm()->entityManager()->persist($this->dataObject);
                }
            }
        }

        $this->persisted = true;
        return $this;
    }

    /**
     * @return bool
     */
    public function execute()
    {
        $this->persist();

        $this->orm()->entityManager()->flush();
        return $this->orm()->entityManager()->contains($this->dataObject);
    }
}