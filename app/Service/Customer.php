<?php

namespace App\Service;

class Customer
{
    private $orm;
    private $operations = [];

    public function operations()
    {
        return $this->operations;
    }

    /**
     * Sets operations cycle form data read
     * @param string $uuid
     */
    public function setLifeCycleFormData($uuid = '')
    {
        if (empty($uuid)) {
            // $uuid = $this->uuid();
        }

        $customer = new \Commerce\Customer(new \Commerce\CustomerData($uuid), $this->orm());
        $this->operations[\Commerce\CustomerData::class] = $customer->foundData();


        $user = new \Account\User(new \Account\UserData($uuid), $this->orm());
        $userData = $user->foundData();

        $userProfile = new \Account\UserProfile(new \Account\UserProfileData($uuid), $this->orm());
        $userData->setProfileData($userProfile->foundData());

        $this->operations[\Account\UserData::class] = $userData;


        $creditCard = new \Payment\CreditCard(new \Payment\CreditCardData($uuid), $this->orm());
        $creditCardData = $creditCard->foundData();

        $payment = new \Payment\PaymentPreference(new \Payment\PaymentPreferenceData($uuid), $this->orm());
        $creditCardData->setPaymentPreference($payment->foundData());

        $billing = new \Payment\BillingSchedule(new \Payment\BillingScheduleData($uuid), $this->orm());
        $creditCardData->setBillingSchedule($billing->foundData());

        $this->operations[\Payment\CreditCardData::class] = $creditCardData;
    }

    public function orm()
    {
        if ($this->orm === null) {
            $this->orm = new \App\Service\ORM();
        }
        return $this->orm;
    }

    /**
     * Sets operations cycle list data read
     * @param string $uuid
     */
    public function setLifeCycleListData($uuid = '')
    {
        $userProfile = new \Account\UserProfile(
            new \Account\UserProfileData($uuid),
            $this->orm());
        $this->operations[\Account\UserProfileData::class] = $userProfile->findAll();
    }

    /**
     * Sets operations cycle post xhr data create
     * @param array $postData
     */
    public function setLifeCyclePostXhrData(array $postData)
    {

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

        $customer = new \Commerce\Customer(
            $customerData,
            $this->orm());
        $this->operations[\Commerce\Customer::class] = $customer;

        // --------
        $userData = new \Account\UserData($uuid);
        $userData->setUsername($postData['username']);
        $userData->setPasswd($postData['password']);
        // $userData->setRpasswd($postData['rpassword']);

        $user = new \Account\User(
            $userData,
            $this->orm());
        $this->operations[\Account\User::class] = $user;

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

        $userProfile = new \Account\UserProfile($userProfileData, $this->orm());
        $this->operations[\Account\UserProfile::class] = $userProfile;

        // ---------
        $creditCardData = new \Payment\CreditCardData($uuid);
        $creditCardData->setName($postData['card_name']);
        $creditCardData->setCvc($postData['card_cvc']);
        $creditCardData->setExpiryDate($postData['card_expiry_date']);
        $creditCardData->setNumber($postData['card_number']);
        $creditCardData->setStatus(0);

        $creditCard = new \Payment\CreditCard(
            $creditCardData,
            $this->orm());
        $this->operations[\Payment\CreditCard::class] = $creditCard;

        // ----------
        $autoPayCC = false;
        if (isset($postData['payment']) && in_array("1", $postData['payment'])) {
            $autoPayCC = true;
        }

        $notifyMonthly = 0;
        if (isset($postData['payment']) && in_array("2", $postData['payment'])) {
            $notifyMonthly = 30;
        }
        $payPreference = new \Payment\PaymentPreferenceData($uuid);
        $payPreference->setAutopay($autoPayCC);
        $payPreference->setMethod(1);
        $payPreference->setStatus(0);

        $paymentPreference = new \Payment\PaymentPreference(
            $payPreference,
            $this->orm());
        $this->operations[\Payment\PaymentPreference::class] = $paymentPreference;

        // ---------
        $billingNotifyData = new \Payment\BillingScheduleData($uuid);
        $billingNotifyData->setPeriod($notifyMonthly);

        $billingSchedule = new \Payment\BillingSchedule(
            $billingNotifyData,
            $this->orm());
        $this->operations[\Payment\BillingSchedule::class] = $billingSchedule;

    }

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
