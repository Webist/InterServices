<?php


namespace App\Source;


use App\Contract\Behave\Statement;

class CustomerStatement implements Statement
{
    private $postData;

    public function __construct(array $postData)
    {
        $this->postData = $postData;
    }

    /**
     * Builds operations from React objects
     * @param null $uuid
     * @param $service \App\Service\Customer
     */
    final public function postXhrReacts($uuid = null, $service)
    {
        // Customer operand/entity
        $customerData = new \Commerce\CustomerData($uuid);
        $customerData->setStatus(1);
        $customerData->setLocale('en');
        $customerData->setState(1);
        $customerData->setTimezone('Europa/Amsterdam');
        // $customerData->setCreatedAt()

        $service->applyReact(get_class($customerData), new \Commerce\Customer($customerData, $service->orm()));

        // @todo password_verify();

        // User operand/entity
        $userData = new \Account\UserData($uuid);
        $userData->setName($this->postData['username']);
        $userData->setPasswd($this->postData['password']);
        // $userData->setRpasswd($this->postData['rpassword']);

        $service->applyReact(get_class($userData), new \Account\User($userData, $service->orm()));

        // User Profile operand/entity
        $userProfileData = new \Account\UserProfileData($uuid);
        $userProfileData->setGender($this->postData['gender']);
        $userProfileData->setFullName($this->postData['fullname']);

        $userProfileData->setEmail($this->postData['email']);
        $userProfileData->setPhone($this->postData['phone']);

        $userProfileData->setAddress($this->postData['address']);
        $userProfileData->setZipcode($this->postData['zipcode']);
        $userProfileData->setCity($this->postData['city']);
        $userProfileData->setCountry($this->postData['country']);

        $userProfileData->setRemarks($this->postData['remarks']);

        $service->applyReact(get_class($userProfileData), new \Account\UserProfile($userProfileData, $service->orm()));

        // Credit-card info operand/entity
        $creditCardData = new \Payment\CreditCardData($uuid);
        $creditCardData->setName($this->postData['card_name']);
        $creditCardData->setCvc($this->postData['card_cvc']);
        $creditCardData->setExpiryDate($this->postData['card_expiry_date']);
        $creditCardData->setNumber($this->postData['card_number']);
        $creditCardData->setStatus(0);

        // Credit-card payment preference
        $service->applyReact(get_class($creditCardData), new \Payment\CreditCard($creditCardData, $service->orm()));

        // Payment preferences
        if (isset($this->postData['payment'])) {

            $autoPayCC = false;
            if (in_array("1", $this->postData['payment'])) {
                $autoPayCC = true;
            }

            $notifyMonthly = 0;
            if (in_array("2", $this->postData['payment'])) {
                $notifyMonthly = 30;
            }

            $payPreference = new \Payment\PaymentPreferenceData($uuid);
            $payPreference->setAutopay($autoPayCC);
            $payPreference->setMethod(1);
            $payPreference->setStatus(0);

            $service->applyReact(get_class($payPreference), new \Payment\PaymentPreference($payPreference, $service->orm()));

            // Notification-schedule billing operand/entity
            $billingNotifyData = new \Payment\BillingScheduleData($uuid);
            $billingNotifyData->setPeriod($notifyMonthly);

            $service->applyReact(get_class($billingNotifyData), new \Payment\BillingSchedule($billingNotifyData, $service->orm()));
        }
    }

    /**
     * Customer email operations, build User, UserProfile
     * @param null $uuid
     * @param $service \App\Service\Customer
     */
    public function emailPostXhrReacts($uuid = null, $service)
    {
        $userData = new \Account\UserData($uuid);
        $userData->setName($this->postData['name']);
        $userData->setPasswd(1);

        $service->applyReact(get_class($userData), new \Account\User($userData, $service->orm()));

        $userProfileData = new \Account\UserProfileData($uuid);
        $userProfileData->setEmail($this->postData['email']);
        $userProfileData->setPhone($this->postData['phone']);
        $userProfileData->setFullName($this->postData['name']);
        $userProfileData->setGender(0);
        $userProfileData->setAddress('');
        $userProfileData->setCity('');
        $userProfileData->setCountry('');
        $userProfileData->setRemarks('');

        $service->applyReact(get_class($userProfileData), new \Account\UserProfile($userProfileData, $service->orm()));
    }
}