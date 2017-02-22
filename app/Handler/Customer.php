<?php


namespace App\Handler;

use App\Spec\ORM;

class Customer implements ORM
{
    /**
     * Holds route, input information and access to generic handler
     * @var Main
     */
    private $main;

    /**
     * Provides instantiation of defined class
     * @var Service
     */
    private $service;

    /**
     * Unique id
     * @var
     */
    private static $uuid;

    /**
     * Holds data storage handler object
     * @var \Doctrine\ORM\EntityManager
     */
    private static $entityManager;

    /**
     * Holds operations (in a global state) to make consumable (e.g. a callback via service)
     * @var array
     */
    private static $operations = [];

    /**
     * Customer constructor.
     * @param Main $main
     * @param Service $service
     */
    public function __construct(Main $main, Service $service)
    {
        $this->main = $main;
        $this->service = $service;

        /** @var \App\Service\DoctrineEntityManager $doctrine */
        $doctrine = $this->service(self::DOCTRINE);
        self::$entityManager = $doctrine->entityManager();
    }

    /**
     *
     * @param string $serviceName
     * @param null $callable
     * @return object
     */
    public function service(string $serviceName, $callable = null)
    {
        // As of PHP 7.1.x we cannot assign anonymous function in arguments, fix this by if statement.
        if(!$callable){
            $callable = function () {};
        }

        return $this->service->service($serviceName, $callable);
    }

    /**
     * Generates UUID
     * @anecdote Intent of uuid is to enable a distributed environment, like micro-services,
     * without significant central coordination.
     *
     * @anecdote There's generally two reason to use UUIDs
     * You do not want a database (or some other authority) to centrally control the identity of records.
     * There's a chance that multiple components may independently generate a non-unique identifier.
     *
     * @return string
     */
    public function uuid()
    {
        if(self::$uuid === null){
            $uuid4 = \Ramsey\Uuid\Uuid::uuid4();
            self::$uuid = $uuid4->toString();
        }
        return self::$uuid;
    }

    /**
     * Builds Customer mutation operations
     * @param array $postData
     * @param $uuid
     */
    final public static function buildOperations(array $postData, $uuid)
    {
        // Customer operand/entity
        $customerData = new \Commerce\CustomerData($uuid);
        $customerData->setStatus(1);
        $customerData->setLocale('en');
        $customerData->setState(1);
        $customerData->setTimezone('Europa/Amsterdam');

        self::$operations[] = $customer = new \Commerce\Customer($customerData, self::$entityManager);
        // $customer->setOperator('ADD');

        // User operand/entity
        $userData = new \Account\UserData($uuid);
        $userData->setFullname($postData['fullname']);
        $userData->setPasswd($postData['password']);
        // $userData->setRpasswd($postData['rpassword']);
        $userData->setUsername($postData['username']);

        self::$operations[] = $user = new \Account\User($userData, self::$entityManager);

        // User Profile operand/entity
        $userProfileData = new \Account\UserProfileData($uuid);
        $userProfileData->setAddress($postData['address']);
        $userProfileData->setCity($postData['city']);
        $userProfileData->setCountry($postData['country']);
        $userProfileData->setGender($postData['gender']);
        $userProfileData->setPhone($postData['phone']);

        $userProfileData->setRemarks($postData['remarks']);

        self::$operations[] = $userProfile = new \Account\UserProfile($userProfileData, self::$entityManager);

        // Credit-card info operand/entity
        $creditCardData = new \Payment\CreditCardData($uuid);
        $creditCardData->setName($postData['card_name']);
        $creditCardData->setCvc($postData['card_number']);
        $creditCardData->setExpiryDate($postData['card_cvc']);
        $creditCardData->setNumber($postData['card_expiry_date']);
        $creditCardData->setStatus(0);

        // Credit-card payment preference
        self::$operations[] = $creditCard = new \Payment\CreditCard($creditCardData, self::$entityManager);

        // Payment preferences
        $payPreference = new \Payment\PaymentPreferenceData($uuid);
        $payPreference->setMethod($postData['payment'][0]);
        $payPreference->setAutopay($postData['payment'][1]);
        $payPreference->setStatus(0);

        self::$operations[] = $pay = new \Payment\Pay($payPreference, self::$entityManager);

        // Notification-schedule billing operand/entity
        $billingNotifyData = new \Notify\BillingScheduleData($uuid);
        $billingNotifyData->setPeriod(\Notify\BillingScheduleSpec::MONTHLY);

        self::$operations[] = $billingSchedule = new \Notify\BillingSchedule($billingNotifyData, self::$entityManager);
    }

    final public static function getOperations()
    {
        return self::$operations;
    }

}