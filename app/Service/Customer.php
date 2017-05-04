<?php

namespace App\Service;

class Customer
{
    private $orm;

    private $operations = [];

    /**
     * Customer constructor.
     * @param \App\Contract\Behave\Statement $statement
     * @param \App\Operator\Customer $operator
     */
    public function __construct(\App\Contract\Behave\Statement $statement, \App\Operator\Customer $operator)
    {

        $this->statement = $statement;
        $this->operator = $operator;
    }

    public function uuidByEmail($email)
    {
        $customerQuery = new \App\Source\CustomerQuery([]);
        $userProfileData = $customerQuery->userProfileDataByEmailReacts($email, $this);

        if ($userProfileData) {
            return $userProfileData->getId();
        }
    }

    public function postXhrDataOperations(\App\Source\CustomerStatement $statement, $uuid = null)
    {
        if (empty($uuid)) {
            $uuid = $this->uuid();
        }

        $statement->postXhrReacts($uuid, $this);
    }

    public function uuid()
    {
        $uuid = \Ramsey\Uuid\Uuid::uuid4();
        return $uuid->toString();
    }

    public function formDataOperations(\App\Source\CustomerQuery $statement, $uuid = null)
    {
        if (empty($uuid)) {
            // $uuid = $this->uuid();
        }
        $statement->formDataReacts($uuid, $this);
    }

    public function listDataOperations(\App\Source\CustomerQuery $statement, $uuid = null)
    {
        if (empty($uuid)) {
            // $uuid = $this->uuid();
        }

        $statement->listDataReacts($uuid, $this);
    }

    public function emailPostXhrDataOperations(\App\Source\CustomerStatement $statement, $email)
    {
        if (empty($email)) {
            return;
        }

        // find userProfileData by email
        $repo = $this->orm()->entityManager()->getRepository(\Account\UserProfileData::class);
        $userProfileData = $repo->findOneBy(['email' => $email]);

        if (!$userProfileData) {
            $statement->emailPostXhrReacts($this->uuid(), $this);
        }

    }

    public function orm()
    {
        if ($this->orm === null) {
            $this->orm = new \App\Service\ORM();
        }
        return $this->orm;
    }

    public function applyReact($key, $react)
    {
        $this->operations[$key] = $react;
    }

    public function get()
    {
        return $this->operations;
    }

    public function mutate($persistOnly = false)
    {
        $returnValue = new \App\ReturnValue\Customer();

        /** @var \Commerce\Customer $statement */
        foreach ($this->operations as $statement) {
            $className = get_class($statement);

            if ($persistOnly) {
                $statement->persist();
            }

            if (!$statement->execute()) {
                $returnValue->addFailureError($className);
            } else {
                $returnValue->addSucceedMessage($className);
            }
        }

        return $returnValue;
    }
}
