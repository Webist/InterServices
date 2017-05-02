<?php


namespace App\Source;


class CustomerOperation
{
    private $postData;

    public function __construct(array $postData)
    {
        $this->postData = $postData;
    }
    /**
     * Builds operations from Command objects
     *
     * @param null $uuid
     * @return array
     */
    final public function postXhrOperations($uuid, \App\Service\ORM $orm)
    {
        $operations = [];
        // Customer operand/entity
        $customerData = new \Commerce\CustomerData($uuid);
        $customerData->setStatus(1);
        $customerData->setLocale('en');
        $customerData->setState(1);
        $customerData->setTimezone('Europa/Amsterdam');
        // $customerData->setCreatedAt()

        $operations[] = $customer = new \Commerce\Customer($customerData, $orm);

        // @todo password_verify();

        // User operand/entity
        $userData = new \Account\UserData($uuid);
        $userData->setName($this->postData['username']);
        $userData->setPasswd($this->postData['password']);
        // $userData->setRpasswd($this->postData['rpassword']);

        $operations[] = $user = new \Account\User($userData, $orm);

        // User Profile operand/entity
        $userProfileData = new \Account\UserProfileData($uuid);
        $userProfileData->setGender($this->postData['gender']);
        $userProfileData->setFullName($this->postData['fullname']);

        $userProfileData->setEmail($this->postData['email']);
        $userProfileData->setPhone($this->postData['phone']);

        $userProfileData->setAddress($this->postData['address']);
        $userProfileData->setZipcode($this->postData['zipcode']);
        $userProfileData->setCity($this->postData['city']);
        $userProfileData->setCountry($this->postData['country']);

        $userProfileData->setRemarks($this->postData['remarks']);

        $operations[] = $userProfile = new \Account\UserProfile($userProfileData, $orm);

        // Credit-card info operand/entity
        $creditCardData = new \Payment\CreditCardData($uuid);
        $creditCardData->setName($this->postData['card_name']);
        $creditCardData->setCvc($this->postData['card_cvc']);
        $creditCardData->setExpiryDate($this->postData['card_expiry_date']);
        $creditCardData->setNumber($this->postData['card_number']);
        $creditCardData->setStatus(0);

        // Credit-card payment preference
        $operations[] = $creditCard = new \Payment\CreditCard($creditCardData, $orm);

        // Payment preferences
        if (isset($this->postData['payment'])) {

            $autoPayCC = false;
            if (in_array("1", $this->postData['payment'])) {
                $autoPayCC = true;
            }

            $notifyMonthly = 0;
            if (in_array("2", $this->postData['payment'])) {
                $notifyMonthly = 30;
            }

            $payPreference = new \Payment\PaymentPreferenceData($uuid);
            $payPreference->setAutopay($autoPayCC);
            $payPreference->setMethod(1);
            $payPreference->setStatus(0);

            $operations[] = $pay = new \Payment\PaymentPreference($payPreference, $orm);

            // Notification-schedule billing operand/entity
            $billingNotifyData = new \Payment\BillingScheduleData($uuid);
            $billingNotifyData->setPeriod($notifyMonthly);

            $operations[] = $billingSchedule = new \Payment\BillingSchedule($billingNotifyData, $orm);
        }

        return $operations;
    }

    /**
     * Customer email operations, build User, UserProfile, array collection
     * @param string $uuid
     * @param \App\Service\ORM $orm
     * @return array
     */
    public function emailPostXhrOperations(string $uuid, \App\Service\ORM $orm)
    {
        $postData = $this->postData;

        $customerQuery = new CustomerQuery([], $orm);
        $userProfileData = $customerQuery->userProfileDataByEmail($postData['email']);

        $operations = [];
        // no-user matched, then create new user
        if (!$userProfileData) {

            $userData = $customerQuery->userData($uuid, false);
            $userData->setName($postData['name']);
            $userData->setPasswd(1);

            $userProfileData = new \Account\UserProfileData($uuid);
            $userProfileData->setEmail($postData['email']);
            $userProfileData->setPhone($postData['phone']);
            $userProfileData->setFullName('');
            $userProfileData->setGender(0);
            $userProfileData->setAddress('');
            $userProfileData->setCity('');
            $userProfileData->setCountry('');
            $userProfileData->setRemarks('');

            $operations[] = new \Account\User($userData, $orm);
            $operations[] = new \Account\UserProfile($userProfileData, $orm);
        }

        return $operations;
    }
}