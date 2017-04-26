<?php


namespace App\Handler;


use App\Spec\ORM;

class Customer implements \App\Spec\Customer, ORM
{
    /**
     * Holds route, input information and access to generic handler
     * @var Main
     */
    private $main;

    /**
     * Customer constructor.
     * @param Main $main
     */
    public function __construct(Main $main)
    {
        $this->main = $main;
    }

    public function main()
    {
        return $this->main;
    }

    public function container()
    {
        return $this->main->container();
    }

    /**
     * @param $postData
     * @param null $uuid
     * @return array
     */
    public function postXhr($postData, $uuid = null)
    {
        \Assert\Assertion::notEmpty($postData);

        /** @var \App\Service\Customer $customerService */
        $customerService = $this->container()->get(self::CUSTOMER, function () {
        });
        return $customerService->mutate(
            $customerService->buildOperations($postData, $uuid)
        );
    }

    /**
     * @param $uuid
     * @param $customerData \App\Spec\Customer::CUSTOMER_DATA
     * @return array
     */
    public function edit($uuid, $customerData)
    {
        if($customerData !== \App\Spec\Customer::CUSTOMER_EDIT) {
            throw \InvalidArgumentException('Invlid argument CUSTOMER_EDIT');
        }

        /** @var \App\Service\DoctrineORM $doctrine */
        $doctrine = $this->container()->get(self::DOCTRINE, function(){});
        $entityManager = $doctrine->entityManager();

        $customer = null;
        if($uuid) {
            $repo = $entityManager->getRepository(\Commerce\CustomerData::class);
            $customer = $repo->find($uuid);
        }

        if ($customer) {

            $repo = $entityManager->getRepository(\Account\UserData::class);
            $customerData['userData'] = $userData = $repo->find($uuid);

            $repo = $entityManager->getRepository(\Account\UserProfileData::class);
            $customerData['userProfileData'] = $userProfileData = $repo->find($uuid);
            $userData->setProfileData($userProfileData);

            $repo = $entityManager->getRepository(\Payment\CreditCardData::class);
            $customerData['creditCardData'] = $creditCardData = $repo->find($uuid);
            $repo = $entityManager->getRepository(\Payment\PaymentPreferenceData::class);
            $preferenceData = $repo->find($uuid);
            $creditCardData->setPaymentPreference($preferenceData);
            $repo = $entityManager->getRepository(\Billing\ScheduleData::class);
            $billingSchedule = $repo->find($uuid);
            $creditCardData->setBillingSchedule($billingSchedule);

        } else {

            // $customerData = new \Commerce\CustomerData($uuid);
            $customerData['userData'] = $userData = new \Account\UserData($uuid);
            $customerData['userProfileData'] = $userProfileData = new \Account\UserProfileData($uuid);
            $userData->setProfileData($userProfileData);

            $customerData['creditCardData'] = $creditCardData = new \Payment\CreditCardData($uuid);
            $preferenceData = new \Payment\PaymentPreferenceData($uuid);
            $creditCardData->setPaymentPreference($preferenceData);
            $billingSchedule = new \Billing\ScheduleData($uuid);
            $creditCardData->setBillingSchedule($billingSchedule);
        }

        return $customerData;
    }

    /**
     * @return array
     */
    public function get()
    {
        /** @var \App\Service\DoctrineORM $doctrine */
        $doctrine = $this->container()->get(self::DOCTRINE, function(){});
        $repo = $doctrine->entityManager()->getRepository(\Account\UserProfileData::class);
        return $repo->findAll();
    }

}