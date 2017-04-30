<?php


namespace App\Source;


class CustomerCommand
{
    private $postData;
    private $entityManager;

    public function __construct(array $postData, \Doctrine\ORM\EntityManager $entityManager)
    {
        $this->postData = $postData;
        $this->entityManager = $entityManager;
    }
    /**
     *
     * @param null $uuid
     * @return array
     */
    final public function postXhrOperations($uuid)
    {
        $entityManager = $this->entityManager;

        $operations = [];
        // Customer operand/entity
        $customerData = new \Commerce\CustomerData($uuid);
        $customerData->setStatus(1);
        $customerData->setLocale('en');
        $customerData->setState(1);
        $customerData->setTimezone('Europa/Amsterdam');

        $operations[] = $customer = new \Commerce\Customer($customerData, $entityManager);
        // return $operations;

        // @todo password_verify();

        // User operand/entity
        $userData = new \Account\UserData($uuid);
        $userData->setName($this->postData['username']);
        $userData->setPasswd($this->postData['password']);
        // $userData->setRpasswd($this->postData['rpassword']);

        $operations[] = $user = new \Account\User($userData, $entityManager);

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

        $operations[] = $userProfile = new \Account\UserProfile($userProfileData, $entityManager);

        // Credit-card info operand/entity
        $creditCardData = new \Payment\CreditCardData($uuid);
        $creditCardData->setName($this->postData['card_name']);
        $creditCardData->setCvc($this->postData['card_cvc']);
        $creditCardData->setExpiryDate($this->postData['card_expiry_date']);
        $creditCardData->setNumber($this->postData['card_number']);
        $creditCardData->setStatus(0);

        // Credit-card payment preference
        $operations[] = $creditCard = new \Payment\CreditCard($creditCardData, $entityManager);

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

            $operations[] = $pay = new \Payment\Pay($payPreference, $entityManager);

            // Notification-schedule billing operand/entity
            $billingNotifyData = new \Payment\BillingScheduleData($uuid);
            $billingNotifyData->setPeriod($notifyMonthly);

            $operations[] = $billingSchedule = new \Payment\Schedule($billingNotifyData, $entityManager);
        }

        return $operations;
    }

    /**
     * Customer email operations, build User, UserProfile, array collection
     * @param string $uuid
     * @return array
     */
    public function emailPostXhrOperations(string $uuid)
    {
        $entityManager = $this->entityManager;
        $postData = $this->postData;

        $customerQuery = new CustomerQuery([], $entityManager);
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

            $operations[] = new \Account\User($userData, $entityManager);
            $operations[] = new \Account\UserProfile($userProfileData, $entityManager);
        }

        return $operations;
    }
}