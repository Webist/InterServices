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
        $arrayMap[\Account\UserData::class]->setProfileData($arrayMap[\Account\UserProfileData::class]);
        $arrayMap[\Payment\CreditCardData::class]->setPaymentPreference($arrayMap[\Payment\PaymentPreferenceData::class]);
        $arrayMap[\Payment\CreditCardData::class]->setBillingSchedule($arrayMap[\Payment\BillingScheduleData::class]);

        $formContent = new Element($arrayMap[\Account\UserData::class]);
        $formContent->require(dirname(dirname(__DIR__)) . '/web/metronic/form-customer/form.php');

        $account = new Element($arrayMap[\Account\UserData::class]);
        $account->require(dirname(dirname(__DIR__)) . '/web/metronic/form-customer/account.details.php');
        $formContent->addElement(':formAccountDetails', $account);

        $profile = new Element($arrayMap[\Account\UserData::class]->profileData());
        $profile->require(dirname(dirname(__DIR__)) . '/web/metronic/form-customer/profile.details.php');
        $formContent->addElement(':formProfileDetails', $profile);

        $billing = new Element($arrayMap[\Payment\CreditCardData::class]);
        $billing->require(dirname(dirname(__DIR__)) . '/web/metronic/form-customer/billing.details.php');
        $formContent->addElement(':formBillingDetails', $billing);

        $confirm = new Element($arrayMap[\Account\UserData::class]);
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