<?php

namespace App\Service;

class Customer
{
    private const SECTIONS = ['form' => [], 'list' => []];
    private const SECTIONS_MESSAGE = ['error' => 'Given sectionName `%s` is not allowed'];
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
     * Maintain unit, build queries array, lifeCycle
     *
     * A request, as an intent, goes trough strategical process.
     * It will be validated, sanitized, planned (prioritized),
     * policies applied (such as bad word policy),
     * converted to internal language
     * and (partly or whole) accepted or rejected.
     *
     * @param string $uuid
     * @param string $sectionName
     * @return bool
     * @throws \Exception
     */
    public function maintainUnit($uuid = '', $sectionName = 'form'): bool
    {
        if (!isset(self::SECTIONS[$sectionName])) {
            throw new \Exception(sprintf(self::SECTIONS_MESSAGE['error'], $sectionName));
        }

        $userProfile = new \Account\UserProfile(new \Account\UserProfileData($uuid), $this->orm());

        // list build
        if ($sectionName == 'list') {
            $this->queries[\Account\UserProfileData::class] = $userProfile->findAll();
            return true;
        }

        // form build
        $customer = new \Commerce\Customer(new \Commerce\CustomerData($uuid), $this->orm());

        $this->queries[\Commerce\CustomerData::class] = $customer->foundData();

        $user = new \Account\User(new \Account\UserData($uuid), $this->orm());
        $userData = $user->foundData();
        $userData->setProfileData($userProfile->foundData());

        $this->queries[\Account\UserData::class] = $userData;

        $creditCard = new \Payment\CreditCard(new \Payment\CreditCardData($uuid), $this->orm());
        $creditCardData = $creditCard->foundData();

        $payment = new \Payment\PaymentPreference(new \Payment\PaymentPreferenceData($uuid), $this->orm());
        $creditCardData->setPaymentPreference($payment->foundData());

        $billing = new \Payment\BillingSchedule(new \Payment\BillingScheduleData($uuid), $this->orm());
        $creditCardData->setBillingSchedule($billing->foundData());

        $this->queries[\Payment\CreditCardData::class] = $creditCardData;
        return true;
    }

    private function orm()
    {
        if ($this->orm === null) {
            $this->orm = new \App\Service\ORM();
        }
        return $this->orm;
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
     * @return bool
     */
    public function maintainArrayMap(array $arrayMap): bool
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

        $this->queries[\Payment\CreditCardData::class] = $customerData;

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

        return true;
    }

    /**
     * Set operations, build operations array, lifeCycle
     * @return bool
     * @throws \Exception
     */
    public function setArrayMapOperations(): bool
    {
        if (empty($this->queries)) {
            throw new \Exception('Array Map Operations not allowed before maintain Array Map');
        }

        $customer = new \Commerce\Customer(
            $this->queries[\Commerce\CustomerData::class],
            $this->orm());
        $this->operations[\Commerce\Customer::class] = $customer;

        $user = new \Account\User(
            $this->queries[\Account\UserData::class],
            $this->orm());
        $this->operations[\Account\User::class] = $user;

        $userProfile = new \Account\UserProfile(
            $this->queries[\Account\UserProfileData::class],
            $this->orm());
        $this->operations[\Account\UserProfile::class] = $userProfile;

        $creditCard = new \Payment\CreditCard(
            $this->queries[\Payment\CreditCardData::class],
            $this->orm());
        $this->operations[\Payment\CreditCard::class] = $creditCard;

        $paymentPreference = new \Payment\PaymentPreference(
            $this->queries[\Payment\PaymentPreferenceData::class],
            $this->orm());
        $this->operations[\Payment\PaymentPreference::class] = $paymentPreference;

        $billingSchedule = new \Payment\BillingSchedule(
            $this->queries[\Payment\BillingScheduleData::class],
            $this->orm());
        $this->operations[\Payment\BillingSchedule::class] = $billingSchedule;

        return true;
    }

    /**
     * @param bool $persistOnly
     * @return \Commerce\ReturnValue
     */
    public function execute($persistOnly = false)
    {
        $returnValue = new \Commerce\ReturnValue();

        foreach ($this->operations as $operation => $statement) {
            if ($persistOnly) {
                $statement->persist();
            }

            if (!$statement->execute()) {
                $returnValue->addFailureError($operation);
            } else {
                $returnValue->addSucceedMessage($operation);
            }
        }

        return $returnValue;
    }
}
