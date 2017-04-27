<?php


namespace App\Source;


use App\Spec\ORM;

class CustomerCommand implements ORM
{
    private $container;

    public function __construct(\Service\Container $container)
    {
        $this->container = $container;
    }
    /**
     *
     * @param array $postData
     * @param null $uuid
     * @return array
     */
    final public function postXhrOperations(array $postData, $uuid = null)
    {

        /** @var \App\Service\DoctrineORM $doctrine */
        $doctrine = $this->container->get(self::DOCTRINE, function(){});
        $entityManager = $doctrine->entityManager();

        if (empty($uuid)) {

            // A userProfile might be created after sending an eMail
            $user = new \Account\User(new \Account\UserData($uuid), $entityManager);
            $userProfileData = $user->userProfileDataByEmail($postData['email']);

            if($userProfileData){
                $uuid = $userProfileData->getId();
            } else {
                $uuid = \Ramsey\Uuid\Uuid::uuid4()->toString();
            }
        }

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
        $userData->setName($postData['username']);
        $userData->setPasswd($postData['password']);
        // $userData->setRpasswd($postData['rpassword']);

        $operations[] = $user = new \Account\User($userData, $entityManager);

        // User Profile operand/entity
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

        $operations[] = $userProfile = new \Account\UserProfile($userProfileData, $entityManager);

        // Credit-card info operand/entity
        $creditCardData = new \Payment\CreditCardData($uuid);
        $creditCardData->setName($postData['card_name']);
        $creditCardData->setCvc($postData['card_cvc']);
        $creditCardData->setExpiryDate($postData['card_expiry_date']);
        $creditCardData->setNumber($postData['card_number']);
        $creditCardData->setStatus(0);

        // Credit-card payment preference
        $operations[] = $creditCard = new \Payment\CreditCard($creditCardData, $entityManager);

        // Payment preferences
        if (isset($postData['payment'])) {

            $autoPayCC = false;
            if (in_array("1", $postData['payment'])) {
                $autoPayCC = true;
            }

            $notifyMonthly = 0;
            if (in_array("2", $postData['payment'])) {
                $notifyMonthly = 30;
            }

            $payPreference = new \Payment\PaymentPreferenceData($uuid);
            $payPreference->setAutopay($autoPayCC);
            $payPreference->setMethod(1);
            $payPreference->setStatus(0);

            $operations[] = $pay = new \Payment\Pay($payPreference, $entityManager);

            // Notification-schedule billing operand/entity
            $billingNotifyData = new \Billing\ScheduleData($uuid);
            $billingNotifyData->setPeriod($notifyMonthly);

            $operations[] = $billingSchedule = new \Billing\Schedule($billingNotifyData, $entityManager);
        }

        return $operations;
    }
}