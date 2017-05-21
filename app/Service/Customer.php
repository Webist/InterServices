<?php

namespace App\Service;


class Customer
{
    /**
     * @var \App\Service\ORM
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

    /** In context fetch, when no data (from storage) then create a new unit */
    const OPERATOR_NEW = 'new';

    const OPERATOR_FIND = 'find';
    const OPERATOR_FIND_ALL = 'findAll';

    /**
     * @return ORM
     */
    private function orm()
    {
        if ($this->orm === null) {
            $this->orm = new \App\Service\ORM();
        }
        return $this->orm;
    }

    private function newUnit()
    {
        $unit = [];
        $uuid = null;
        $unit[\Commerce\CustomerData::class] = new \Commerce\CustomerData($uuid);
        $unit[\Account\UserData::class] = new \Account\UserData($uuid);
        $unit[\Account\UserProfileData::class] = new \Account\UserProfileData($uuid);
        $unit[\Payment\CreditCardData::class] = new \Payment\CreditCardData($uuid);
        $unit[\Payment\PaymentPreferenceData::class] = new \Payment\PaymentPreferenceData($uuid);
        $unit[\Payment\BillingScheduleData::class] = new \Payment\BillingScheduleData($uuid);
        return $unit;
    }

    private function existingUnit()
    {
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
     * Maintaining the lifeCycle of a request, as an intent, goes trough strategical process.
     * It will be validated, sanitized, planned (prioritized),
     * policies applied (such as bad word policy),
     * eventually converted to internal language
     * and (partly or whole) accepted or rejected.
     *
     * @param string $operator
     * @return array
     */
    public function maintainMutationUnit(string $operator): array
    {
        $this->operator = $operator;
        return $this->newUnit();
    }

    /**
     * Maintain form unit lifeCycle
     *
     * A request, as an intent, goes trough strategical process.
     * It will be validated, sanitized, planned (prioritized),
     * policies applied (such as bad word policy),
     * converted to internal language
     * and (partly or whole) accepted or rejected.
     *
     * @param string $operator
     * @return array
     */
    public function maintainFormUnit(string $operator): array
    {
        $this->operator = $operator;

        if ($this->operator == self::OPERATOR_FIND) {
            $this->operations = $this->existingUnit();
        }

        if ($this->operator == self::OPERATOR_NEW) {
            $this->operations = $this->newUnit();
        }
        return $this->operations;
    }

    /**
     * @see function maintainF
     * @param string $operator
     * @return array
     */
    public function maintainListUnit(string $operator): array
    {
        $this->operator = $operator;

        if ($this->operator == self::OPERATOR_FIND_ALL) {
            $em = $this->orm()->entityManager();
            $this->operations[\Account\UserProfileData::class] = $em->getRepository(\Account\UserProfileData::class);
        }

        if ($this->operator == self::OPERATOR_NEW) {
            $this->operations[\Account\UserProfileData::class] = new \Account\UserProfileData(null);
        }
        return $this->operations;
    }

    /**
     * @param array $queries
     * @param array $arrayMap
     * @return array
     */
    public function mutationUnitOperations(array $queries, array $arrayMap)
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
            $this->operations[$class] = new \Statement\Operator($object, $this->operator, $this->orm());
        }
        return $this->operations;
    }

    public function unitOperations(array $queries)
    {
        return $queries;
    }

    /**
     * @param string $uuid
     * @return array
     */
    public function get($uuid = ''): array
    {
        $results = [];

        /** @var \Doctrine\ORM\EntityRepository $operation */
        foreach ($this->operations as $class => $operation) {

            if ($this->operator == self::OPERATOR_NEW) {
                $results[$class] = $operation;
                continue;
            }

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
     * @return \Statement\Statement
     */
    public function mutate(array $operations)
    {
        $statement = new \Statement\Statement($operations, new \Statement\ReturnValue());
        return $statement->execute();
    }
}
