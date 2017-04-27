<?php


namespace App\Source;


use App\Spec\ORM;

class Customer implements ORM
{
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function formData($uuid)
    {
        /** @var \App\Service\DoctrineORM $doctrine */
        $doctrine = $this->container->get(self::DOCTRINE, function(){});
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


    public function listData()
    {
        /** @var \App\Service\DoctrineORM $doctrine */
        $doctrine = $this->container->get(self::DOCTRINE, function(){});
        return $doctrine->entityManager()->getRepository(\Account\UserProfileData::class);
    }

}