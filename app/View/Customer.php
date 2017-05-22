<?php


namespace View;


use Dom\Html\Element;
use Payment\BillingScheduleData;
use Payment\PaymentPreferenceData;

class Customer
{
    /**
     * @param array $arrayMap
     * @return \Dom\Html\Element
     */
    public static function form(array $arrayMap)
    {
        $userData = $arrayMap[\Account\UserData::class];

        $userProfileData = $arrayMap[\Account\UserProfileData::class];
        if (empty($userProfileData)) {
            $userProfileData = new \Account\UserProfileData();
            $userProfileData->setId($userData->getId());
        }
        $userData->setProfileData($userProfileData);

        $paymentPreference = $arrayMap[\Payment\PaymentPreferenceData::class];
        if (empty($paymentPreference)) {
            $paymentPreference = new PaymentPreferenceData();
            $paymentPreference->setId($userData->getId());
        }
        $arrayMap[\Payment\CreditCardData::class]->setPaymentPreference($paymentPreference);

        $billingSchedule = $arrayMap[\Payment\BillingScheduleData::class];
        if (empty($billingSchedule)) {
            $billingSchedule = new BillingScheduleData();
            $billingSchedule->setId($userData->getId());
        }
        $arrayMap[\Payment\CreditCardData::class]->setBillingSchedule($billingSchedule);

        $formContent = new Element($userData);
        $formContent->require(dirname(dirname(__DIR__)) . '/web/metronic/form-customer/form.php');

        $account = new Element($userData);
        $account->require(dirname(dirname(__DIR__)) . '/web/metronic/form-customer/account.details.php');
        $formContent->addElement(':formAccountDetails', $account);

        $profile = new Element($userData->profileData());
        $profile->require(dirname(dirname(__DIR__)) . '/web/metronic/form-customer/profile.details.php');
        $formContent->addElement(':formProfileDetails', $profile);

        $billing = new Element($arrayMap[\Payment\CreditCardData::class]);
        $billing->require(dirname(dirname(__DIR__)) . '/web/metronic/form-customer/billing.details.php');
        $formContent->addElement(':formBillingDetails', $billing);

        $confirm = new Element($userData);
        $confirm->require(dirname(dirname(__DIR__)) . '/web/metronic/form-customer/confirm.details.php');
        $formContent->addElement(':confirmDetails', $confirm);

        return $formContent;
    }

    /**
     * @param $arrayMap
     * @return \Dom\Html\Element
     */
    public static function list(array $arrayMap)
    {
        $userProfileData = new Element($arrayMap[\Account\UserProfileData::class]);
        $userProfileData->require(dirname(dirname(__DIR__)) . '/web/metronic/table-customer/list.php');

        return $userProfileData;
    }
}