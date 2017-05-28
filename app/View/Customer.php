<?php


namespace View;


use Dom\Html\Element;

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
        $userData->setProfileData($userProfileData);

        $creditCardData = $arrayMap[\Payment\CreditCardData::class];

        $paymentPreference = $arrayMap[\Payment\PaymentPreferenceData::class];
        $creditCardData->setPaymentPreference($paymentPreference);

        $billingSchedule = $arrayMap[\Payment\BillingScheduleData::class];
        $creditCardData->setBillingSchedule($billingSchedule);

        $formContent = new Element($userData);
        $formContent->require(dirname(dirname(__DIR__)) . '/web/metronic/form-customer/form.php');

        $account = new Element($userData);
        $account->require(dirname(dirname(__DIR__)) . '/web/metronic/form-customer/account.details.php');
        $formContent->addElement(':formAccountDetails', $account);

        $profile = new Element($userData->profileData());
        $profile->require(dirname(dirname(__DIR__)) . '/web/metronic/form-customer/profile.details.php');
        $formContent->addElement(':formProfileDetails', $profile);

        $billing = new Element($creditCardData);
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
        $userProfileData = $arrayMap[\Account\UserProfileData::class];

        $userProfile = new Element($userProfileData);
        $userProfile->require(dirname(dirname(__DIR__)) . '/web/metronic/table-customer/list.php');

        return $userProfile;
    }
}