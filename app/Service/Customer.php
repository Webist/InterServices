<?php

namespace App\Service;


/**
 *
 * Domain-centric domain service.
 * This means communications are with a persistence layer.
 * Model and relations live in application via object orientation.
 *
 * LifeCycle of units, model
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
     * @var string
     */
    private $uuid;

    /** Length, UniqueId for a new empty item  */
    const NEW_ITEM_UUID_LENGTH = 13;
    /** Length, UniqueId for to create or an existing item */
    const EXISTING_ITEM_UUID_LENGTH = 32;

    /**
     * @var \Connector\ORM
     */
    private $orm;

    /** @var \Commerce\CustomerData */
    private $customerData;
    /** @var  \Account\UserData */
    private $userData;
    /** @var \Account\UserProfileData */
    private $userProfileData;
    /** @var \Payment\CreditCardData */
    private $creditCardData;
    /** @var \Payment\PaymentPreferenceData */
    private $paymentPreferenceData;
    /** @var \Payment\BillingScheduleData */
    private $billingScheduleData;

    /**
     * @return \Connector\ORM
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
    private function setOperator($operator)
    {
        $this->operator = $operator;

        if ($this->operator == self::OPERATOR_NEW) {
            $this->setId(uniqid());
        }
        if ($this->operator == self::OPERATOR_PERSIST) {
            $this->setId(\Ramsey\Uuid\Uuid::uuid4()->toString());
        }
        return $this;
    }

    /**
     * @param $uuid
     * @return $this
     */
    private function setId($uuid)
    {
        $this->uuid = $uuid;
        return $this;
    }

    /**
     * @return string
     */
    private function uuid()
    {
        return $this->uuid;
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
     * Aggregates the business case as a new model. Default domain model.
     */
    private function newModel(): void
    {
        $uuid = $this->uuid();
        $this->customerData = new \Commerce\CustomerData($uuid);
        $this->userData = new \Account\UserData($uuid);
        $this->userProfileData = new \Account\UserProfileData($uuid);
        $this->creditCardData = new \Payment\CreditCardData($uuid);
        $this->paymentPreferenceData = new \Payment\PaymentPreferenceData($uuid);
        $this->billingScheduleData = new \Payment\BillingScheduleData($uuid);
    }

    /**
     * Aggregates the business case as an existing repository model. Default data model.
     */
    private function repositoryModel(): void
    {
        $em = $this->orm()->entityManager();
        $this->customerData = $em->getRepository(\Commerce\CustomerData::class);
        $this->userData = $em->getRepository(\Account\UserData::class);
        $this->userProfileData = $em->getRepository(\Account\UserProfileData::class);
        $this->creditCardData = $em->getRepository(\Payment\CreditCardData::class);
        $this->paymentPreferenceData = $em->getRepository(\Payment\PaymentPreferenceData::class);
        $this->billingScheduleData = $em->getRepository(\Payment\BillingScheduleData::class);
    }

    /**
     * Aggregates the business case "mutate" as a new model.
     * @param string $operator
     * @return bool
     */
    public function maintainReturnValue(string $operator): bool
    {
        $this->setOperator($operator)->newModel();
        return true;
    }
    /**
     * Hydrates the business case "mutate" as executable operations.
     *
     * @param array $arrayMap
     * @return array
     */
    public function returnValueOperations(array $arrayMap): array
    {
        $operations = [];

        // Extra feature, In context edit, when user-email already exists then use that by email matched uuid
        $uuidByEmail = $this->findUuidByEmail($this->userProfileData->getEmail());
        if (!empty($uuidByEmail)) {
            $this->customerData->setId($uuidByEmail);
            $this->userData->setId($uuidByEmail);
            $this->userProfileData->setId($uuidByEmail);
            $this->creditCardData->setId($uuidByEmail);
            $this->paymentPreferenceData->setId($uuidByEmail);
            $this->billingScheduleData->setId($uuidByEmail);
        }

        $this->customerData->setStatus(1);
        $this->customerData->setLocale('en');
        $this->customerData->setState(1);
        $this->customerData->setTimezone('Europa/Amsterdam');
        $operations[\Commerce\CustomerData::class] = new \Statement\Operation($this->customerData, $this->operator);

        $this->userData->setUsername($arrayMap['username']);
        $this->userData->setPasswd($arrayMap['password']);
        // $this->userData->setRpasswd($arrayMap['rpassword']);
        $operations[\Account\UserData::class] = new \Statement\Operation($this->userData, $this->operator);

        $this->userProfileData->setGender($arrayMap['gender']);
        $this->userProfileData->setFullName($arrayMap['fullname']);
        $this->userProfileData->setEmail($arrayMap['email']);
        $this->userProfileData->setPhone($arrayMap['phone']);
        $this->userProfileData->setAddress($arrayMap['address']);
        $this->userProfileData->setZipcode($arrayMap['zipcode']);
        $this->userProfileData->setCity($arrayMap['city']);
        $this->userProfileData->setCountry($arrayMap['country']);
        $this->userProfileData->setRemarks($arrayMap['remarks']);
        $operations[\Account\UserProfileData::class] = new \Statement\Operation($this->userProfileData, $this->operator);

        $this->creditCardData->setName($arrayMap['card_name']);
        $this->creditCardData->setCvc($arrayMap['card_cvc']);
        $this->creditCardData->setExpiryDate($arrayMap['card_expiry_date']);
        $this->creditCardData->setNumber($arrayMap['card_number']);
        $this->creditCardData->setStatus(0);
        $operations[\Payment\CreditCardData::class] = new \Statement\Operation($this->creditCardData, $this->operator);

        $autoPayCC = false;
        if (isset($arrayMap['payment']) && in_array("1", $arrayMap['payment'])) {
            $autoPayCC = true;
        }

        $this->paymentPreferenceData->setAutopay($autoPayCC);
        $this->paymentPreferenceData->setMethod(1);
        $this->paymentPreferenceData->setStatus(0);
        $operations[\Payment\PaymentPreferenceData::class] = new \Statement\Operation($this->paymentPreferenceData, $this->operator);

        $notifyMonthly = 0;
        if (isset($arrayMap['payment']) && in_array("2", $arrayMap['payment'])) {
            $notifyMonthly = 30;
        }
        $this->billingScheduleData->setPeriod($notifyMonthly);
        $operations[\Payment\BillingScheduleData::class] = new \Statement\Operation($this->billingScheduleData, $this->operator);

        return $operations;
    }

    /**
     * Gets the business case "mutate" model results
     * @param array $operations
     * @return \Statement\Operator
     */
    public function mutate(array $operations)
    {
        $statement = new \Statement\Operator($operations, new \Statement\ReturnValue());
        return $statement->execute();
    }

    /**
     * Aggregates the business case "form" as a new or an repository model.
     * @param string $operator
     * @return bool
     */
    public function maintainForm(string $operator): bool
    {
        $this->setOperator($operator);

        if ($this->operator == self::OPERATOR_FIND) {
            $this->repositoryModel();
            return true;
        }

        $this->newModel();
        return true;
    }

    /**
     * Gets the business case "form" model results
     * @param array $arrayMap
     * @return array
     */
    public function form(array $arrayMap): array
    {
        $unit = [];
        if ($this->operator == self::OPERATOR_FIND) {
            $unit[\Commerce\CustomerData::class] = $this->customerData->find($arrayMap['uuid']);
            $unit[\Account\UserData::class] = $this->userData->find($arrayMap['uuid']);
            $unit[\Account\UserProfileData::class] = $this->userProfileData->find($arrayMap['uuid']);
            $unit[\Payment\CreditCardData::class] = $this->creditCardData->find($arrayMap['uuid']);
            $unit[\Payment\PaymentPreferenceData::class] = $this->paymentPreferenceData->find($arrayMap['uuid']);
            $unit[\Payment\BillingScheduleData::class] = $this->billingScheduleData->find($arrayMap['uuid']);
            return $unit;
        }

        if ($this->operator == self::OPERATOR_NEW) {
            $unit[\Commerce\CustomerData::class] = $this->customerData;
            $unit[\Account\UserData::class] = $this->userData;
            $unit[\Account\UserProfileData::class] = $this->userProfileData;
            $unit[\Payment\CreditCardData::class] = $this->creditCardData;
            $unit[\Payment\PaymentPreferenceData::class] = $this->paymentPreferenceData;
            $unit[\Payment\BillingScheduleData::class] = $this->billingScheduleData;

            return $unit;
        }
    }

    /**
     * Aggregates the business case "list" as a new or an repository model.
     * @param string $operator
     * @return bool
     */
    public function maintainList(string $operator): bool
    {
        $this->setOperator($operator);

        if ($this->operator == self::OPERATOR_FIND_ALL) {
            $this->userProfileData = $this->orm()->entityManager()->getRepository(\Account\UserProfileData::class);
            return true;
        }

        $this->userProfileData = new \Account\UserProfileData($this->uuid());
        return true;
    }

    /**
     * Gets the business case "list" model results
     * @param array $arrayMap
     * @return array
     */
    public function list(array $arrayMap): array
    {
        $unit = [];
        if ($this->operator == self::OPERATOR_FIND_ALL) {
            $unit[\Account\UserProfileData::class] = $this->userProfileData->findAll();
        }

        if ($this->operator == self::OPERATOR_NEW) {
            $unit[\Account\UserProfileData::class] = $this->userProfileData;
        }
        return $unit;
    }
}
