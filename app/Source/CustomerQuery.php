<?php


namespace App\Source;


use App\Spec\ORM;

class CustomerQuery implements ORM
{
    private $data = [];
    private $entityManager;

    public function __construct(array $data, \Doctrine\ORM\EntityManager $entityManager)
    {
        $this->data = $data;
        $this->entityManager = $entityManager;
    }

    public function customerData($uuid)
    {
        $customerData = new \Commerce\CustomerData($uuid);
        if ($uuid) {
            $repo = $this->entityManager->getRepository(\Commerce\CustomerData::class);
            $customerData = $repo->find($uuid);
        }
        return $customerData;
    }

    public function userProfileData($uuid)
    {
        $userProfileData = new \Account\UserProfileData($uuid);
        if ($uuid) {
            $repo = $this->entityManager->getRepository(\Account\UserProfileData::class);
            $userProfileData = $repo->find($uuid);
        }
        return $userProfileData;
    }

    public function userProfileDataByEmail($email)
    {
        $repo = $this->entityManager->getRepository(\Account\UserProfileData::class);
        /** @var \Account\UserProfileData $userProfileData */
        return $repo->findOneBy(['email' => $email]);
    }

    public function userData($uuid, $setProfileData = true)
    {
        $userData = new \Account\UserData($uuid);
        if ($uuid) {
            $repo = $this->entityManager->getRepository(\Account\UserData::class);
            $userData = $repo->find($uuid);
        }

        if($setProfileData){
            $userData->setProfileData($this->userProfileData($uuid));
        }

        return $userData;
    }

    public function paymentPreferenceData($uuid)
    {
        $paymentPreferenceData = new \Payment\PaymentPreferenceData($uuid);
        if ($uuid) {
            $repo = $this->entityManager->getRepository(\Payment\PaymentPreferenceData::class);
            $paymentPreferenceData = $repo->find($uuid);
        }
        return $paymentPreferenceData;
    }

    public function billingScheduleData($uuid)
    {
        $billingScheduleData = new \Payment\BillingScheduleData($uuid);
        if ($uuid) {
            $repo = $this->entityManager->getRepository(\Payment\BillingScheduleData::class);
            $billingScheduleData = $repo->find($uuid);
        }
        return $billingScheduleData;
    }

    public function creditCardData($uuid, $setPaymentPreference = true, $setBillingSchedule = true)
    {
        $creditCardData = new \Payment\CreditCardData($uuid);
        if($uuid){
            $repo = $this->entityManager->getRepository(\Payment\CreditCardData::class);
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

    public function formData($uuid)
    {
        $this->data['customerData'] = $this->customerData($uuid);
        $this->data['userData'] = $this->userData($uuid);
        $this->data['creditCardData'] = $this->creditCardData($uuid);

        return $this->data;
    }

    public function listData()
    {
        return $this->entityManager->getRepository(\Account\UserProfileData::class)
            ->findAll();
    }

}