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
     * Maintains the form data request
     *
     * A request, as an intent, goes trough strategical process.
     * It will be validated, sanitized, planned (prioritized),
     * policies applied (such as bad word policy),
     * converted to internal language
     * and (partly or whole) accepted or rejected.
     * @param string $uuid
     */
    public function maintainLifeCycleFormData($uuid = '')
    {
        $customer = new \Commerce\Customer(new \Commerce\CustomerData($uuid), $this->orm());
        $this->queries[\Commerce\CustomerData::class] = $customer->foundData();


        $user = new \Account\User(new \Account\UserData($uuid), $this->orm());
        $userData = $user->foundData();

        $userProfile = new \Account\UserProfile(new \Account\UserProfileData($uuid), $this->orm());
        $userData->setProfileData($userProfile->foundData());

        $this->queries[\Account\UserData::class] = $userData;


        $creditCard = new \Payment\CreditCard(new \Payment\CreditCardData($uuid), $this->orm());
        $creditCardData = $creditCard->foundData();

        $payment = new \Payment\PaymentPreference(new \Payment\PaymentPreferenceData($uuid), $this->orm());
        $creditCardData->setPaymentPreference($payment->foundData());

        $billing = new \Payment\BillingSchedule(new \Payment\BillingScheduleData($uuid), $this->orm());
        $creditCardData->setBillingSchedule($billing->foundData());

        $this->queries[\Payment\CreditCardData::class] = $creditCardData;
    }

    private function orm()
    {
        if ($this->orm === null) {
            $this->orm = new \App\Service\ORM();
        }
        return $this->orm;
    }

    /**
     * Maintains the list data request
     * @param string $uuid
     */
    public function maintainLifeCycleListData($uuid = '')
    {
        $userProfile = new \Account\UserProfile(new \Account\UserProfileData($uuid), $this->orm());
        $this->queries[\Account\UserProfileData::class] = $userProfile->findAll();
    }

    /**
     * Maintains the post xhr data request
     *
     * A request, as an intent, goes trough strategical process.
     * It will be validated, sanitized, planned (prioritized),
     * policies applied (such as bad word policy),
     * converted to internal language
     * and (partly or whole) accepted or rejected.
     *
     * @param array $postData
     */
    public function maintainLifeCyclePostXhrData(array $postData)
    {
        \Assert\Assertion::keyExists($postData, 'uuid');
        \Assert\Assertion::email($postData['email']);

        // UPDATE, based on eMail
        if (empty($postData['uuid'])) {

            if (!empty($postData['email'])) {
                $repo = $this->orm()->entityManager()->getRepository(\Account\UserProfileData::class);
                $userProfileData = $repo->findOneBy(['email' => $postData['email']]);
                if ($userProfileData) {
                    $postData['uuid'] = $userProfileData->getId();
                }
            }
        }

        // CREATE, based on empty uuid, after internal data
        if (empty($postData['uuid'])) {
            $postData['uuid'] = \Ramsey\Uuid\Uuid::uuid4()->toString();
        }

        $uuid = $postData['uuid'];

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
        $userData->setUsername($postData['username']);
        $userData->setPasswd($postData['password']);
        // $userData->setRpasswd($postData['rpassword']);

        $this->queries[\Account\UserData::class] = $userData;

        // --------
        $userProfileData = new \Account\UserProfileData($uuid);
        $userProfileData->setGender($postData['gender']);
        $userProfileData->setFullName($postData['fullname']);
        $userProfileData->setEmail($postData['email']);
        $userProfileData->setPhone($postData['phone']);
        $userProfileData->setAddress($postData['address']);
        $userProfileData->setZipcode($postData['zipcode']);
        $userProfileData->setCity($postData['city']);
        $userProfileData->setCountry($postData['country']);
        $userProfileData->setRemarks($postData['remarks']);

        $this->queries[\Account\UserProfileData::class] = $userProfileData;

        // ---------
        $creditCardData = new \Payment\CreditCardData($uuid);
        $creditCardData->setName($postData['card_name']);
        $creditCardData->setCvc($postData['card_cvc']);
        $creditCardData->setExpiryDate($postData['card_expiry_date']);
        $creditCardData->setNumber($postData['card_number']);
        $creditCardData->setStatus(0);

        $this->queries[\Payment\CreditCardData::class] = $customerData;

        // ----------
        $autoPayCC = false;
        if (isset($postData['payment']) && in_array("1", $postData['payment'])) {
            $autoPayCC = true;
        }

        $payPreference = new \Payment\PaymentPreferenceData($uuid);
        $payPreference->setAutopay($autoPayCC);
        $payPreference->setMethod(1);
        $payPreference->setStatus(0);

        $this->queries[\Payment\PaymentPreferenceData::class] = $payPreference;

        // ---------
        $notifyMonthly = 0;
        if (isset($postData['payment']) && in_array("2", $postData['payment'])) {
            $notifyMonthly = 30;
        }

        $billingNotifyData = new \Payment\BillingScheduleData($uuid);
        $billingNotifyData->setPeriod($notifyMonthly);

        $this->queries[\Payment\BillingScheduleData::class] = $billingNotifyData;
    }

    /**
     * Sets operations cycle post xhr data create
     */
    public function setLifeCyclePostXhrData()
    {
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

    }

    /**
     * @param bool $persistOnly
     * @return \Commerce\ReturnValue
     */
    public function mutate($persistOnly = false)
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
