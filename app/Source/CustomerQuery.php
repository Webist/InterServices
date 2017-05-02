<?php


namespace App\Source;


class CustomerQuery
{
    private $data = [];
    /** @var \App\Service\ORM */
    private $orm;

    public function __construct(array $data, \App\Service\ORM $orm)
    {
        $this->data = $data;
        $this->orm = $orm;
    }

    public function userProfileDataByEmail($email)
    {
        $repo = $this->orm->entityManager()->getRepository(\Account\UserProfileData::class);
        /** @var \Account\UserProfileData $userProfileData */
        return $repo->findOneBy(['email' => $email]);
    }

    public function formDataOperations($uuid)
    {
        $this->data['customerData'] = $this->customerData($uuid);
        $this->data['userData'] = $this->userData($uuid);
        $this->data['creditCardData'] = $this->creditCardData($uuid);

        return $this->data;
    }

    public function customerData($uuid)
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

    public function listDataOperations()
    {
        return $this->orm->entityManager()->getRepository(\Account\UserProfileData::class)
            ->findAll();
    }

}