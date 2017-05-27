<?php

namespace App\Service;


/**
 *
 * Domain-centric domain service.
 * This means communications are with a persistence layer.
 * Model and relations live in application via object orientation.
 *
 * LifeCycle of units
 *
 * Maintaining the lifeCycle of a request, as an intent, goes trough strategical process.
 * It will be validated, sanitized, planned (prioritized),
 * policies applied (such as bad word policy),
 * eventually converted to internal language
 * and (partly or whole) accepted or rejected.
 *
 *
 * Class Customer
 * @package App\Service
 */
class Customer
{
    /**
     * @var \Connector\ORM
     */
    private $orm;

    /**
     * Collection operations
     * @var array
     */
    private $operations = [];

    /**
     * Defined operator
     * @var string
     */
    private $operator;
    /** In context mutate, when array map then persist (insert) a new unit into the store */
    const OPERATOR_PERSIST = \Statement\Operation::PERSIST;
    /** In context mutate, when array map then merge (update) a new unit into the store, uuid required  */
    const OPERATOR_MERGE = \Statement\Operation::MERGE;

    /** In context fetch, when no input (e.g. uuid) provided then compose a new unit, so that a new item can be created */
    const OPERATOR_NEW = 'new';
    /** In context fetch, when no filter (e.g. uuid) was provided then find all records */
    const OPERATOR_FIND_ALL = 'findAll';
    /** In context fetch, when uuid is provided then find by that id, so that the item can be modified */
    const OPERATOR_FIND = 'find';

    /**
     * @return ORM
     */
    private function orm()
    {
        if ($this->orm === null) {
            $this->orm = new \Connector\ORM();
        }
        return $this->orm;
    }

    /**
     * @param $operator
     * @return $this
     */
    private function operator($operator)
    {
        $this->operator = $operator;
        return $this;
    }

    private function returnValueUnit()
    {
        $unit = [];
        $unit[\Commerce\CustomerData::class] = new \Commerce\CustomerData();
        $unit[\Account\UserData::class] = new \Account\UserData();
        $unit[\Account\UserProfileData::class] = new \Account\UserProfileData();
        $unit[\Payment\CreditCardData::class] = new \Payment\CreditCardData();
        $unit[\Payment\PaymentPreferenceData::class] = new \Payment\PaymentPreferenceData();
        $unit[\Payment\BillingScheduleData::class] = new \Payment\BillingScheduleData();
        return $unit;
    }

    private function formUnit()
    {
        if ($this->operator == self::OPERATOR_NEW) {
            return $this->returnValueUnit();
        }

        if ($this->operator == self::OPERATOR_FIND) {
            $unit = [];
            $em = $this->orm()->entityManager();
            $unit[\Commerce\CustomerData::class] = $em->getRepository(\Commerce\CustomerData::class);
            $unit[\Account\UserData::class] = $em->getRepository(\Account\UserData::class);
            $unit[\Account\UserProfileData::class] = $em->getRepository(\Account\UserProfileData::class);
            $unit[\Payment\CreditCardData::class] = $em->getRepository(\Payment\CreditCardData::class);
            $unit[\Payment\PaymentPreferenceData::class] = $em->getRepository(\Payment\PaymentPreferenceData::class);
            $unit[\Payment\BillingScheduleData::class] = $em->getRepository(\Payment\BillingScheduleData::class);
            return $unit;
        }
    }

    private function listUnit()
    {
        $unit = [];
        if ($this->operator == self::OPERATOR_FIND_ALL) {
            $em = $this->orm()->entityManager();
            $unit[\Account\UserProfileData::class] = $em->getRepository(\Account\UserProfileData::class);
        }

        if ($this->operator == self::OPERATOR_NEW) {
            $unit[\Account\UserProfileData::class] = new \Account\UserProfileData();
        }

        return $unit;
    }

    /**
     * @param $email
     * @return string
     */
    private function findUuidByEmail($email): string
    {
        $repo = $this->orm()->entityManager()->getRepository(\Account\UserProfileData::class);
        $userProfileData = $repo->findOneBy(['email' => $email]);
        if ($userProfileData) {
            return $userProfileData->getId();
        }
        return '';
    }

    /**
     * Maintain mutation unit lifeCycle
     *
     * @param string $operator
     * @return array
     */
    public function maintainReturnValueUnit(string $operator): array
    {
        return $this->operator($operator)->returnValueUnit();
    }

    /**
     * Maintain form unit lifeCycle
     *
     * @param string $operator
     * @return array
     */
    public function maintainFormUnit(string $operator): array
    {
        return $this->operations = $this->operator($operator)->formUnit();
    }

    /**
     * @param string $operator
     * @return array
     */
    public function maintainListUnit(string $operator): array
    {
        return $this->operations = $this->operator($operator)->listUnit();
    }

    /**
     * @param array $queries
     * @param array $arrayMap
     * @return array
     */
    public function returnValueOperations(array $queries, array $arrayMap)
    {
        $uuid = $arrayMap['uuid'];

        /** @var \Commerce\CustomerData $customerData */
        $customerData = $queries[\Commerce\CustomerData::class];
        $customerData->setId($uuid);
        $customerData->setStatus(1);
        $customerData->setLocale('en');
        $customerData->setState(1);
        $customerData->setTimezone('Europa/Amsterdam');
        // $customerData->setCreatedAt()

        /** @var \Account\UserData $userData */
        $userData = $queries[\Account\UserData::class];
        $userData->setId($uuid);
        $userData->setUsername($arrayMap['username']);
        $userData->setPasswd($arrayMap['password']);
        // $userData->setRpasswd($arrayMap['rpassword']);

        /** @var \Account\UserProfileData $userProfileData */
        $userProfileData = $queries[\Account\UserProfileData::class];
        $userProfileData->setId($uuid);
        $userProfileData->setGender($arrayMap['gender']);
        $userProfileData->setFullName($arrayMap['fullname']);
        $userProfileData->setEmail($arrayMap['email']);
        $userProfileData->setPhone($arrayMap['phone']);
        $userProfileData->setAddress($arrayMap['address']);
        $userProfileData->setZipcode($arrayMap['zipcode']);
        $userProfileData->setCity($arrayMap['city']);
        $userProfileData->setCountry($arrayMap['country']);
        $userProfileData->setRemarks($arrayMap['remarks']);


        /** @var \Payment\CreditCardData $creditCardData */
        $creditCardData = $queries[\Payment\CreditCardData::class];
        $creditCardData->setId($uuid);
        $creditCardData->setName($arrayMap['card_name']);
        $creditCardData->setCvc($arrayMap['card_cvc']);
        $creditCardData->setExpiryDate($arrayMap['card_expiry_date']);
        $creditCardData->setNumber($arrayMap['card_number']);
        $creditCardData->setStatus(0);

        $autoPayCC = false;
        if (isset($arrayMap['payment']) && in_array("1", $arrayMap['payment'])) {
            $autoPayCC = true;
        }

        /** @var \Payment\PaymentPreferenceData $payPreference */
        $payPreference = $queries[\Payment\PaymentPreferenceData::class];
        $payPreference->setId($uuid);
        $payPreference->setAutopay($autoPayCC);
        $payPreference->setMethod(1);
        $payPreference->setStatus(0);

        $notifyMonthly = 0;
        if (isset($arrayMap['payment']) && in_array("2", $arrayMap['payment'])) {
            $notifyMonthly = 30;
        }

        /** @var \Payment\BillingScheduleData $billingNotifyData */
        $billingNotifyData = $queries[\Payment\BillingScheduleData::class];
        $billingNotifyData->setId($uuid);
        $billingNotifyData->setPeriod($notifyMonthly);

        // In context edit, when user-email already exists then use that by email matched uuid
        $uuidByEmail = $this->findUuidByEmail($userProfileData->getEmail());

        foreach ($queries as $class => $object) {
            if (!empty($uuidByEmail)) {
                $object->setId($uuidByEmail);
            }
            $this->operations[$class] = new \Statement\Operation($object, $this->operator, $this->orm());
        }
        return $this->operations;
    }

    /**
     * @param string $uuid
     * @return array
     */
    public function get($uuid = ''): array
    {
        if ($this->operator == self::OPERATOR_NEW) {
            return $this->operations;
        }

        $results = [];
        /** @var \Doctrine\ORM\EntityRepository $operation */
        foreach ($this->operations as $class => $operation) {

            if ($this->operator == self::OPERATOR_FIND) {
                $object = $operation->find($uuid);

                if ($object && empty($object->getId())) {
                    if (empty($uuid)) {
                        $uuid = \Ramsey\Uuid\Uuid::uuid4()->toString();
                    }
                    $object->setId($uuid);
                }
                $results[$class] = $object;
                continue;
            }

            if ($this->operator == self::OPERATOR_FIND_ALL) {
                $results[$class] = $operation->findAll();
                continue;
            }
        }

        return $results;
    }

    /**
     * @param array $operations
     * @return \Statement\Operator
     */
    public function mutate(array $operations)
    {
        $statement = new \Statement\Operator($operations, new \Statement\ReturnValue());
        return $statement->execute();
    }
}
