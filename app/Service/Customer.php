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

    /**
     * Sets operations
     *
     * @param array $queries
     * @return array
     */
    public function unitOperations(array $queries)
    {
        // In context view, when queries with empty id then fill with a new id, so that every form has an uuid
        $uuid = \Ramsey\Uuid\Uuid::uuid4()->toString();

        foreach ($queries as $class => $action) {

            foreach ($action as $object) {
                if ($object && empty($object->getId())) {
                    $object->setId($uuid);
                }
            }

            // In context fetch, when the operator is find then the ORM returns an one depth object otherwise multidimension array
            if ($this->operator == self::OPERATOR_FIND) {
                $this->operations[$class] = $action[$this->operator];
            } else {
                $this->operations[$class] = $action;
            }

        }

        return $this->operations;
    }

    /**
     * @param array $queries
     * @return array
     */
    public function mutationMapOperations(array $queries)
    {
        // In context edit, when user-email already exists then use that by email matched uuid
        $uuidByEmail = null;
        foreach ($queries as $class => $object) {

            if ($class == \Account\UserProfileData::class) {
                $uuidByEmail = $this->findUuidByEmail($object[$this->operator]->getEmail());
                break;
            }
        }

        foreach ($queries as $class => $object) {
            if (empty($uuidByEmail)) {
                $object[$this->operator]->setId($uuidByEmail);
            }
            $this->operations[$class] = new \Statement\Operator($object[$this->operator], $this->operator, $this->orm());
        }

        return $this->operations;
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
     * Maintain array map, build queries array, lifeCycle
     *
     * Maintaining the lifeCycle of a request, as an intent, goes trough strategical process.
     * It will be validated, sanitized, planned (prioritized),
     * policies applied (such as bad word policy),
     * eventually converted to internal language
     * and (partly or whole) accepted or rejected.
     *
     * @param array $arrayMap
     * @param $operator
     * @return array
     */
    public function maintainMutationMap(array $arrayMap, string $operator): array
    {
        $this->operator = $operator;
        $uuid = $arrayMap['uuid'];

        $queries = [];
        // -------
        $customerData = new \Commerce\CustomerData($uuid);
        $customerData->setStatus(1);
        $customerData->setLocale('en');
        $customerData->setState(1);
        $customerData->setTimezone('Europa/Amsterdam');
        // $customerData->setCreatedAt()

        $queries[\Commerce\CustomerData::class][$operator] = $customerData;

        // --------
        $userData = new \Account\UserData($uuid);
        $userData->setUsername($arrayMap['username']);
        $userData->setPasswd($arrayMap['password']);
        // $userData->setRpasswd($arrayMap['rpassword']);

        $queries[\Account\UserData::class][$operator] = $userData;

        // --------
        $userProfileData = new \Account\UserProfileData($uuid);
        $userProfileData->setGender($arrayMap['gender']);
        $userProfileData->setFullName($arrayMap['fullname']);
        $userProfileData->setEmail($arrayMap['email']);
        $userProfileData->setPhone($arrayMap['phone']);
        $userProfileData->setAddress($arrayMap['address']);
        $userProfileData->setZipcode($arrayMap['zipcode']);
        $userProfileData->setCity($arrayMap['city']);
        $userProfileData->setCountry($arrayMap['country']);
        $userProfileData->setRemarks($arrayMap['remarks']);

        $queries[\Account\UserProfileData::class][$operator] = $userProfileData;

        // ---------
        $creditCardData = new \Payment\CreditCardData($uuid);
        $creditCardData->setName($arrayMap['card_name']);
        $creditCardData->setCvc($arrayMap['card_cvc']);
        $creditCardData->setExpiryDate($arrayMap['card_expiry_date']);
        $creditCardData->setNumber($arrayMap['card_number']);
        $creditCardData->setStatus(0);

        $queries[\Payment\CreditCardData::class][$operator] = $creditCardData;

        // ----------
        $autoPayCC = false;
        if (isset($arrayMap['payment']) && in_array("1", $arrayMap['payment'])) {
            $autoPayCC = true;
        }

        $payPreference = new \Payment\PaymentPreferenceData($uuid);
        $payPreference->setAutopay($autoPayCC);
        $payPreference->setMethod(1);
        $payPreference->setStatus(0);

        $queries[\Payment\PaymentPreferenceData::class][$operator] = $payPreference;

        // ---------
        $notifyMonthly = 0;
        if (isset($arrayMap['payment']) && in_array("2", $arrayMap['payment'])) {
            $notifyMonthly = 30;
        }

        $billingNotifyData = new \Payment\BillingScheduleData($uuid);
        $billingNotifyData->setPeriod($notifyMonthly);

        $queries[\Payment\BillingScheduleData::class][$operator] = $billingNotifyData;

        return $queries;
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
     * @param $uuid
     * @param $operator
     * @return array
     */
    public function maintainFormUnit($uuid, string $operator): array
    {
        $this->operator = $operator;
        $unit = [];
        if ($this->operator == self::OPERATOR_FIND) {
            $em = $this->orm()->entityManager();
            $unit[\Commerce\CustomerData::class][$this->operator] = $em->getRepository(\Commerce\CustomerData::class)->find($uuid);
            $unit[\Account\UserData::class][$this->operator] = $em->getRepository(\Account\UserData::class)->find($uuid);
            $unit[\Account\UserProfileData::class][$this->operator] = $em->getRepository(\Account\UserProfileData::class)->find($uuid);
            $unit[\Payment\CreditCardData::class][$this->operator] = $em->getRepository(\Payment\CreditCardData::class)->find($uuid);
            $unit[\Payment\PaymentPreferenceData::class][$this->operator] = $em->getRepository(\Payment\PaymentPreferenceData::class)->find($uuid);
            $unit[\Payment\BillingScheduleData::class][$this->operator] = $em->getRepository(\Payment\BillingScheduleData::class)->find($uuid);
        }

        if (empty($unit)) {
            $this->operator = self::OPERATOR_NEW;

            $unit[\Commerce\CustomerData::class][$this->operator] = new \Commerce\CustomerData($uuid);
            $unit[\Account\UserData::class][$this->operator] = new \Account\UserData($uuid);
            $unit[\Account\UserProfileData::class][$this->operator] = new \Account\UserProfileData($uuid);
            $unit[\Payment\CreditCardData::class][$this->operator] = new \Payment\CreditCardData($uuid);
            $unit[\Payment\PaymentPreferenceData::class][$this->operator] = new \Payment\PaymentPreferenceData($uuid);
            $unit[\Payment\BillingScheduleData::class][$this->operator] = new \Payment\BillingScheduleData($uuid);
        }

        return $unit;
    }

    /**
     *
     * Maintain list unit lifeCycle
     *
     * A request, as an intent, goes trough strategical process.
     * It will be validated, sanitized, planned (prioritized),
     * policies applied (such as bad word policy),
     * converted to internal language
     * and (partly or whole) accepted or rejected.
     *
     * @param $uuid
     * @param $operator
     * @return array
     */
    public function maintainListUnit($uuid, string $operator): array
    {
        $this->operator = $operator;
        $unit = [];
        if ($operator == self::OPERATOR_FIND_ALL) {
            $em = $this->orm()->entityManager();
            $unit[\Account\UserProfileData::class] = $em->getRepository(\Account\UserProfileData::class)->findAll();
        }

        if (empty($unit)) {
            $this->operator = self::OPERATOR_NEW;
            $unit[\Account\UserProfileData::class][$this->operator] = new \Account\UserProfileData($uuid);
        }
        return $unit;
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->operations;
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
