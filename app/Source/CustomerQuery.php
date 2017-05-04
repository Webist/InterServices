<?php


namespace App\Source;


use App\Contract\Behave\Statement;

class CustomerQuery implements Statement
{
    private $data = [];
    /** @var \App\Service\ORM */
    private $orm;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param $uuid
     * @param $service \App\Service\Customer
     */
    public function formDataReacts($uuid, $service)
    {
        $this->orm = $service->orm();

        $customerData = $this->customerData($uuid);
        $service->applyReact(get_class($customerData), $customerData);

        $userData = $this->userData($uuid);
        $service->applyReact(get_class($userData), $userData);

        $creditCardData = $this->creditCardData($uuid);
        $service->applyReact(get_class($creditCardData), $creditCardData);
    }

    private function customerData($uuid)
    {
        $customerData = new \Commerce\CustomerData($uuid);
        if ($uuid) {
            $repo = $this->orm->entityManager()->getRepository(\Commerce\CustomerData::class);
            $customerData = $repo->find($uuid);
        }
        return $customerData;
    }

    public function userData($uuid, $setProfileData = true)
    {
        $userData = new \Account\UserData($uuid);
        if ($uuid) {
            $repo = $this->orm->entityManager()->getRepository(\Account\UserData::class);
            $userData = $repo->find($uuid);
        }

        if($setProfileData){
            $userData->setProfileData($this->userProfileData($uuid));
        }

        return $userData;
    }

    public function userProfileData($uuid)
    {
        $userProfileData = new \Account\UserProfileData($uuid);
        if ($uuid) {
            $repo = $this->orm->entityManager()->getRepository(\Account\UserProfileData::class);
            $userProfileData = $repo->find($uuid);
        }
        return $userProfileData;
    }

    public function creditCardData($uuid, $setPaymentPreference = true, $setBillingSchedule = true)
    {
        $creditCardData = new \Payment\CreditCardData($uuid);
        if($uuid){
            $repo = $this->orm->entityManager()->getRepository(\Payment\CreditCardData::class);
            $creditCardData = $repo->find($uuid);
        }

        if($setPaymentPreference){
            $creditCardData->setPaymentPreference($this->paymentPreferenceData($uuid));
        }

        if($setBillingSchedule){
            $creditCardData->setBillingSchedule($this->billingScheduleData($uuid));
        }

        return $creditCardData;
    }

    public function paymentPreferenceData($uuid)
    {
        $paymentPreferenceData = new \Payment\PaymentPreferenceData($uuid);
        if ($uuid) {
            $repo = $this->orm->entityManager()->getRepository(\Payment\PaymentPreferenceData::class);
            $paymentPreferenceData = $repo->find($uuid);
        }
        return $paymentPreferenceData;
    }

    public function billingScheduleData($uuid)
    {
        $billingScheduleData = new \Payment\BillingScheduleData($uuid);
        if ($uuid) {
            $repo = $this->orm->entityManager()->getRepository(\Payment\BillingScheduleData::class);
            $billingScheduleData = $repo->find($uuid);
        }
        return $billingScheduleData;
    }

    /**
     * @param $uuid
     * @param $service \App\Service\Customer
     */
    public function listDataReacts($uuid, $service)
    {
        $this->orm = $service->orm();

        if (empty($uuid)) {
            $listData = $this->orm->entityManager()->getRepository(\Account\UserProfileData::class)
                ->findAll();
        } else {
            $listData = $this->orm->entityManager()->getRepository(\Account\UserProfileData::class)
                ->find($uuid);
        }

        $service->applyReact(\Account\UserProfileData::class, $listData);
    }

    /**
     * @param $email
     * @param $service \App\Service\Customer
     */
    public function userProfileDataByEmailReacts($email, $service)
    {
        $this->orm = $service->orm();

        $repo = $this->orm->entityManager()->getRepository(\Account\UserProfileData::class);
        $repo->findOneBy(['email' => $email]);

        $service->applyReact(\Account\UserProfileData::class, $repo->findOneBy(['email' => $email]));
    }

}