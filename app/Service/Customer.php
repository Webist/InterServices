<?php

namespace App\Service;

class Customer
{
    private $orm;
    private $queries = [];
    private $operations = [];

    public function queries()
    {
        return $this->queries;
    }

    public function operations()
    {
        return $this->operations;
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
        \Assert\Assertion::keyExists($arrayMap, 'uuid');
        \Assert\Assertion::email($arrayMap['email']);

        // UPDATE, based on eMail
        if (empty($arrayMap['uuid'])) {

            if (!empty($arrayMap['email'])) {
                $repo = $this->orm()->entityManager()->getRepository(\Account\UserProfileData::class);
                $userProfileData = $repo->findOneBy(['email' => $arrayMap['email']]);
                if ($userProfileData) {
                    $arrayMap['uuid'] = $userProfileData->getId();
                }
            }
        }

        // CREATE, based on empty uuid, after internal data
        if (empty($arrayMap['uuid'])) {
            $arrayMap['uuid'] = \Ramsey\Uuid\Uuid::uuid4()->toString();
        }

        $uuid = $arrayMap['uuid'];

        // -------
        $customerData = new \Commerce\CustomerData($uuid);
        $customerData->setStatus(1);
        $customerData->setLocale('en');
        $customerData->setState(1);
        $customerData->setTimezone('Europa/Amsterdam');
        // $customerData->setCreatedAt()

        $this->queries[\Commerce\CustomerData::class] = $customerData;

        // --------
        $userData = new \Account\UserData($uuid);
        $userData->setUsername($arrayMap['username']);
        $userData->setPasswd($arrayMap['password']);
        // $userData->setRpasswd($arrayMap['rpassword']);

        $this->queries[\Account\UserData::class] = $userData;

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

        $this->queries[\Account\UserProfileData::class] = $userProfileData;

        // ---------
        $creditCardData = new \Payment\CreditCardData($uuid);
        $creditCardData->setName($arrayMap['card_name']);
        $creditCardData->setCvc($arrayMap['card_cvc']);
        $creditCardData->setExpiryDate($arrayMap['card_expiry_date']);
        $creditCardData->setNumber($arrayMap['card_number']);
        $creditCardData->setStatus(0);

        $this->queries[\Payment\CreditCardData::class] = $creditCardData;

        // ----------
        $autoPayCC = false;
        if (isset($arrayMap['payment']) && in_array("1", $arrayMap['payment'])) {
            $autoPayCC = true;
        }

        $payPreference = new \Payment\PaymentPreferenceData($uuid);
        $payPreference->setAutopay($autoPayCC);
        $payPreference->setMethod(1);
        $payPreference->setStatus(0);

        $this->queries[\Payment\PaymentPreferenceData::class] = $payPreference;

        // ---------
        $notifyMonthly = 0;
        if (isset($arrayMap['payment']) && in_array("2", $arrayMap['payment'])) {
            $notifyMonthly = 30;
        }

        $billingNotifyData = new \Payment\BillingScheduleData($uuid);
        $billingNotifyData->setPeriod($notifyMonthly);

        $this->queries[\Payment\BillingScheduleData::class] = $billingNotifyData;

        return $this->queries;
    }

    private function orm()
    {
        if ($this->orm === null) {
            $this->orm = new \App\Service\ORM();
        }
        return $this->orm;
    }

    /**
     * Maintain unit, build queries array, lifeCycle
     *
     * A request, as an intent, goes trough strategical process.
     * It will be validated, sanitized, planned (prioritized),
     * policies applied (such as bad word policy),
     * converted to internal language
     * and (partly or whole) accepted or rejected.
     *
     * @param $uuid
     * @return mixed
     */
    public function maintainFormUnit($uuid)
    {
        $query = new class extends \App\Service\Customer
        {
            private $id;

            public function getId()
            {
                return $this->id;
            }

            public function setId($uuid)
            {
                $this->id = $uuid;
                return $this;
            }

            public function query()
            {
                return function (\Doctrine\ORM\EntityManager $em) {
                    $unit = [];
                    $unit[\Commerce\CustomerData::class] = $em->getRepository(\Commerce\CustomerData::class)->find($this->getId());
                    $unit[\Account\UserData::class] = $em->getRepository(\Account\UserData::class)->find($this->getId());
                    $unit[\Account\UserProfileData::class] = $em->getRepository(\Account\UserProfileData::class)->find($this->getId());
                    $unit[\Payment\CreditCardData::class] = $em->getRepository(\Payment\CreditCardData::class)->find($this->getId());
                    $unit[\Payment\PaymentPreferenceData::class] = $em->getRepository(\Payment\PaymentPreferenceData::class)->find($this->getId());
                    $unit[\Payment\BillingScheduleData::class] = $em->getRepository(\Payment\BillingScheduleData::class)->find($this->getId());
                    return $unit;
                };
            }
        };

        return $query->setId($uuid);
    }

    /**
     * Maintain unit, build queries array, lifeCycle
     *
     * A request, as an intent, goes trough strategical process.
     * It will be validated, sanitized, planned (prioritized),
     * policies applied (such as bad word policy),
     * converted to internal language
     * and (partly or whole) accepted or rejected.
     *
     * @param $uuid
     * @return mixed
     */
    public function maintainListUnit($uuid)
    {
        $query = new class extends \App\Service\Customer
        {
            private $id;

            public function getId()
            {
                return $this->id;
            }

            public function setId($uuid)
            {
                $this->id = $uuid;
                return $this;
            }

            public function query()
            {
                return function (\Doctrine\ORM\EntityManager $em) {
                    $unit = [];
                    $unit[\Account\UserProfileData::class] = $em->getRepository(\Account\UserProfileData::class)->findAll();
                    return $unit;
                };
            }
        };

        return $query->setId($uuid);
    }

    /**
     * @param Customer $operation
     * @return array
     */
    public function get(\App\Service\Customer $operation)
    {
        $this->queries = [];
        return call_user_func($operation->query(), $this->orm()->entityManager());
    }

    /**
     * @param array $operations
     * @return \Statement\Statement
     */
    public function mutate(array $operations)
    {
        $this->queries = [];
        foreach ($operations as $name => $operation) {
            $this->operations[$name] = new \Statement\Operator($operation, $this->orm());
        }

        $statement = new \Statement\Statement($this->operations, new \Statement\ReturnValue());
        return $statement->execute();
    }
}
