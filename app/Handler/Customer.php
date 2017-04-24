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
     * @var \Service\Container
     */
    private $container;


    public function __construct(Main $main)
    {
        $this->main = $main;
        $this->container = $this->main->container();
    }

    public function main()
    {
        return $this->main;
    }

    public function postData($postData, $uuid = null)
    {
        /** @var \App\Service\Customer $customerService */
        $customerService = $this->container->get(self::CUSTOMER, function () {
        });
        return $customerService->mutate(
            $customerService->buildOperations($postData, $uuid));

    }

    public function buildFormHtml($uuid)
    {
        $customerData = null;

        /** @var \App\Service\DoctrineORM $doctrine */
        $doctrine = $this->container->get(self::DOCTRINE, function(){});
        $entityManager = $doctrine->entityManager();

        if($uuid) {
            $repo = $entityManager->getRepository(\Commerce\CustomerData::class);
            $customerData = $repo->find($uuid);
        }

        if ($customerData) {

            $repo = $entityManager->getRepository(\Account\UserData::class);
            $userData = $repo->find($uuid);

            $repo = $entityManager->getRepository(\Account\UserProfileData::class);
            $userProfileData = $repo->find($uuid);
            $userData->setProfileData($userProfileData);

            $repo = $entityManager->getRepository(\Payment\CreditCardData::class);
            $creditCardData = $repo->find($uuid);
            $repo = $entityManager->getRepository(\Payment\PaymentPreferenceData::class);
            $preferenceData = $repo->find($uuid);
            $creditCardData->setPaymentPreference($preferenceData);
            $repo = $entityManager->getRepository(\Billing\ScheduleData::class);
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

        return $this->main->buildContentWith(':pageBaseContent', $formContent);

    }

    public function buildListHtml()
    {
        /** @var \App\Service\DoctrineORM $doctrine */
        $doctrine = $this->container->get(self::DOCTRINE, function(){});

        $repo = $doctrine->entityManager()->getRepository(\Account\UserProfileData::class);
        $userProfileData = $repo->findAll();

        $listContent = new \Html\Element($userProfileData);
        $listContent->require('../web/metronic/table-customer/list.php');

        return $this->main->buildContentWith(':pageBaseContent', $listContent);
    }

}