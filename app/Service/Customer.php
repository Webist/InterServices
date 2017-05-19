<?php

namespace App\Service;


class Customer
{
    private $orm;

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
     * Hydrate's uuid to the objects
     *
     * @param array $queries
     * @return array
     */
    public function prepareOperations(array $queries)
    {
        // UPDATE operation, if there already an uuid or an email match
        foreach ($queries as $classString => $query) {
            if (empty($query->getId())) {
                if ($classString == \Account\UserProfileData::class) {
                    if (!empty($query->getEmail())) {
                        $repo = $this->orm()->entityManager()->getRepository(\Account\UserProfileData::class);
                        $userProfileData = $repo->findOneBy(['email' => $query->getEmail()]);
                        if ($userProfileData) {
                            $uuid = $userProfileData->getId();
                        }
                    }
                }
            } else {
                $uuid = $query->getId();
            }
        }

        // CREATE operation, after internal data check
        if (empty($uuid)) {
            $uuid = \Ramsey\Uuid\Uuid::uuid4()->toString();
        }

        foreach ($queries as $query) {
            $query->setId($uuid);
        }
        return $queries;
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
     * @return array
     */
    public function maintainMutationMap(array $arrayMap): array
    {
        $uuid = $arrayMap['uuid'];

        $queries = [];
        // -------
        $customerData = new \Commerce\CustomerData($uuid);
        $customerData->setStatus(1);
        $customerData->setLocale('en');
        $customerData->setState(1);
        $customerData->setTimezone('Europa/Amsterdam');
        // $customerData->setCreatedAt()

        $queries[\Commerce\CustomerData::class] = $customerData;

        // --------
        $userData = new \Account\UserData($uuid);
        $userData->setUsername($arrayMap['username']);
        $userData->setPasswd($arrayMap['password']);
        // $userData->setRpasswd($arrayMap['rpassword']);

        $queries[\Account\UserData::class] = $userData;

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

        $queries[\Account\UserProfileData::class] = $userProfileData;

        // ---------
        $creditCardData = new \Payment\CreditCardData($uuid);
        $creditCardData->setName($arrayMap['card_name']);
        $creditCardData->setCvc($arrayMap['card_cvc']);
        $creditCardData->setExpiryDate($arrayMap['card_expiry_date']);
        $creditCardData->setNumber($arrayMap['card_number']);
        $creditCardData->setStatus(0);

        $queries[\Payment\CreditCardData::class] = $creditCardData;

        // ----------
        $autoPayCC = false;
        if (isset($arrayMap['payment']) && in_array("1", $arrayMap['payment'])) {
            $autoPayCC = true;
        }

        $payPreference = new \Payment\PaymentPreferenceData($uuid);
        $payPreference->setAutopay($autoPayCC);
        $payPreference->setMethod(1);
        $payPreference->setStatus(0);

        $queries[\Payment\PaymentPreferenceData::class] = $payPreference;

        // ---------
        $notifyMonthly = 0;
        if (isset($arrayMap['payment']) && in_array("2", $arrayMap['payment'])) {
            $notifyMonthly = 30;
        }

        $billingNotifyData = new \Payment\BillingScheduleData($uuid);
        $billingNotifyData->setPeriod($notifyMonthly);

        $queries[\Payment\BillingScheduleData::class] = $billingNotifyData;

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
     * @return array
     */
    public function maintainFormUnit($uuid)
    {
        $unit = [];
        $unit[\Commerce\CustomerData::class] = new \Commerce\CustomerData($uuid);
        $unit[\Account\UserData::class] = new \Account\UserData($uuid);
        $unit[\Account\UserProfileData::class] = new \Account\UserProfileData($uuid);
        $unit[\Payment\CreditCardData::class] = new \Payment\CreditCardData($uuid);
        $unit[\Payment\PaymentPreferenceData::class] = new \Payment\PaymentPreferenceData($uuid);
        $unit[\Payment\BillingScheduleData::class] = new \Payment\BillingScheduleData($uuid);
        return $unit;
    }

    /**
     * Maintain list unit lifeCycle
     *
     * A request, as an intent, goes trough strategical process.
     * It will be validated, sanitized, planned (prioritized),
     * policies applied (such as bad word policy),
     * converted to internal language
     * and (partly or whole) accepted or rejected.
     *
     * @param $uuid
     * @return array
     */
    public function maintainListUnit($uuid)
    {
        $unit = [];
        $unit[\Account\UserProfileData::class] = new \Account\UserProfileData($uuid);
        return $unit;
    }

    /**
     * @param array $operations
     * @return array
     */
    public function get(array $operations)
    {
        $unit = [];
        $em = $this->orm()->entityManager();
        foreach ($operations as $operation) {
            $class = get_class($operation);
            if (empty($operation->getId())) {
                $unit[$class] = $em->getRepository($class)->findAll();
            } else {
                $unit[$class] = $em->getRepository($class)->find($operation->getId());
            }
        }
        return $unit;
    }

    /**
     * @param array $operations
     * @return \Statement\Statement
     */
    public function mutate(array $operations)
    {
        foreach ($operations as $name => $operation) {
            $this->operations[$name] = new \Statement\Operator($operation, $this->orm());
        }

        $statement = new \Statement\Statement($this->operations, new \Statement\ReturnValue());
        return $statement->execute();
    }
}
