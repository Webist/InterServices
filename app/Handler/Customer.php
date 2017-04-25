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

    /**
     * @param $postData
     * @param null $uuid
     * @return array
     */
    public function postData($postData, $uuid = null)
    {
        /** @var \App\Service\Customer $customerService */
        $customerService = $this->container->get(self::CUSTOMER, function () {
        });
        return $customerService->mutate(
            $customerService->buildOperations($postData, $uuid)
        );
    }

    /**
     * @param $uuid
     * @return \Html\Composite
     */
    public function buildFormHtml($uuid)
    {
        /** @var \App\Service\DoctrineORM $doctrine */
        $doctrine = $this->container->get(self::DOCTRINE, function(){});
        $entityManager = $doctrine->entityManager();

        $customerData = null;
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

            // $customerData = new \Commerce\CustomerData($uuid);
            $userData = new \Account\UserData($uuid);
            $userProfileData = new \Account\UserProfileData($uuid);
            $userData->setProfileData($userProfileData);

            $creditCardData = new \Payment\CreditCardData($uuid);
            $preferenceData = new \Payment\PaymentPreferenceData($uuid);
            $creditCardData->setPaymentPreference($preferenceData);
            $billingSchedule = new \Billing\ScheduleData($uuid);
            $creditCardData->setBillingSchedule($billingSchedule);
        }

        $customerFormContent = function () use ($userData, $userProfileData, $creditCardData) {
            $customerView = new \View\Customer();
            return $customerView->formContent($userData, $userProfileData, $creditCardData);
        };

        /** @var \App\Service\Html $htmlService */
        $htmlService = $this->container->get(self::HTML, $customerFormContent);
        return $htmlService->pageBaseContent(include self::DATA_STORAGE_PATH . $this->main->route()['indexKey'] . '.php');

    }

    /**
     * @return \Html\Composite
     */
    public function buildListHtml()
    {
        /** @var \App\Service\DoctrineORM $doctrine */
        $doctrine = $this->container->get(self::DOCTRINE, function(){});
        $repo = $doctrine->entityManager()->getRepository(\Account\UserProfileData::class);
        $userProfileData = $repo->findAll();

        $customerListContent = function () use ($userProfileData) {
            $view = new \View\Customer();
            return $view->listContent($userProfileData);
        };

        /** @var \App\Service\Html $htmlService */
        $htmlService = $this->container->get(self::HTML, $customerListContent);
        return $htmlService->pageBaseContent(include self::DATA_STORAGE_PATH . $this->main->route()['indexKey'] . '.php');
    }

}