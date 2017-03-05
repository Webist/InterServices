<?php


namespace App\Handler;


use App\Spec\HTML;
use App\Spec\ORM;

class Customer implements ORM, HTML
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

    public function main()
    {
        return $this->main;
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
        if (!$callable) {
            $callable = function () {
            };
        }

        /*
        Session info to provide to a service.

        // Generate a refreshable OAuth2 credential for authentication.
        $oAuth2Credential = (new OAuth2TokenBuilder())
            ->fromFile()
            ->build();
        // Construct an API session configured from a properties file and the OAuth2
        $this->session = (new SessionBuilder())
            ->fromFile()
            ->withOAuth2Credential($oAuth2Credential)
            ->build();
         */

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
        if (self::$uuid === null) {
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

        // @todo password_verify();

        // User operand/entity
        $userData = new \Account\UserData($uuid);
        $userData->setName($postData['username']);
        $userData->setPasswd($postData['password']);
        // $userData->setRpasswd($postData['rpassword']);

        self::$operations[] = $user = new \Account\User($userData, self::$entityManager);

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

        self::$operations[] = $userProfile = new \Account\UserProfile($userProfileData, self::$entityManager);

        // Credit-card info operand/entity
        $creditCardData = new \Payment\CreditCardData($uuid);
        $creditCardData->setName($postData['card_name']);
        $creditCardData->setCvc($postData['card_cvc']);
        $creditCardData->setExpiryDate($postData['card_expiry_date']);
        $creditCardData->setNumber($postData['card_number']);
        $creditCardData->setStatus(0);

        // Credit-card payment preference
        self::$operations[] = $creditCard = new \Payment\CreditCard($creditCardData, self::$entityManager);

        // Payment preferences
        if (isset($postData['payment'])) {

            $autoPayCC = 0;
            if (in_array("1", $postData['payment'])) {
                $autoPayCC = 1;
            }

            $notifyMonthly = 0;
            if (in_array("2", $postData['payment'])) {
                $notifyMonthly = 30;
            }

            $payPreference = new \Payment\PaymentPreferenceData($uuid);
            $payPreference->setAutopay($autoPayCC);
            $payPreference->setMethod(1);
            $payPreference->setStatus(0);

            self::$operations[] = $pay = new \Payment\Pay($payPreference, self::$entityManager);

            // Notification-schedule billing operand/entity
            $billingNotifyData = new \Billing\ScheduleData($uuid);
            $billingNotifyData->setPeriod($notifyMonthly);

            self::$operations[] = $billingSchedule = new \Billing\Schedule($billingNotifyData, self::$entityManager);
        }


    }

    final public static function getOperations()
    {
        return self::$operations;
    }


    public function buildFormHtml($uuid)
    {
        $customerData = null;
        if($uuid) {
            $repo = self::$entityManager->getRepository(\Commerce\CustomerData::class);
            $customerData = $repo->find($uuid);
        }

        if ($customerData) {

            $repo = self::$entityManager->getRepository(\Account\UserData::class);
            $userData = $repo->find($uuid);

            $repo = self::$entityManager->getRepository(\Account\UserProfileData::class);
            $userProfileData = $repo->find($uuid);
            $userData->setProfileData($userProfileData);

            $repo = self::$entityManager->getRepository(\Payment\CreditCardData::class);
            $creditCardData = $repo->find($uuid);
            $repo = self::$entityManager->getRepository(\Payment\PaymentPreferenceData::class);
            $preferenceData = $repo->find($uuid);
            $creditCardData->setPaymentPreference($preferenceData);
            $repo = self::$entityManager->getRepository(\Billing\ScheduleData::class);
            $billingSchedule = $repo->find($uuid);
            $creditCardData->setBillingSchedule($billingSchedule);

        } else {

            $customerData = new \Commerce\CustomerData($uuid);
            $userData = new \Account\UserData($uuid);
            $userProfileData = new \Account\UserProfileData($uuid);
            $userData->setProfileData($userProfileData);

            $creditCardData = new \Payment\CreditCardData($uuid);
            $preferenceData = new \Payment\PaymentPreferenceData($uuid);
            $creditCardData->setPaymentPreference($preferenceData);
            $billingSchedule = new \Billing\ScheduleData($uuid);
            $creditCardData->setBillingSchedule($billingSchedule);
        }


        $formContent = new \Html\Element($userData);
        $formContent->require('../web/metronic/form-customer/form.php');

        $account = new \Html\Element($userData);
        $account->require('../web/metronic/form-customer/account.details.php');
        $formContent->addElement(':formAccountDetails', $account);

        $profile = new \Html\Element($userProfileData);
        $profile->require('../web/metronic/form-customer/profile.details.php');
        $formContent->addElement(':formProfileDetails', $profile);

        $billing = new \Html\Element($creditCardData);
        $billing->require('../web/metronic/form-customer/billing.details.php');
        $formContent->addElement(':formBillingDetails', $billing);

        $confirm = new \Html\Element($userData);
        $confirm->require('../web/metronic/form-customer/confirm.details.php');
        $formContent->addElement(':confirmDetails', $confirm);

        return $this->main()->mainHandler()->buildContentWith(':pageBaseContent', $formContent);

    }

    public function buildListHtml()
    {
        $repo = self::$entityManager->getRepository(\Account\UserProfileData::class);
        $userProfileData = $repo->findAll();

        $listContent = new \Html\Element($userProfileData);
        $listContent->require('../web/metronic/table-customer/list.php');

        return $this->main()->mainHandler()->buildContentWith(':pageBaseContent', $listContent);
    }

}