<?php


namespace View;


use Html\Element;

class Customer
{
    /**
     * @param array $data
     * @return \Html\Element
     */
    public static function form(array $data)
    {
        $formContent = new Element($data[\Account\UserData::class]);
        $formContent->require(dirname(dirname(__DIR__)) . '/web/metronic/form-customer/form.php');

        $account = new Element($data[\Account\UserData::class]);
        $account->require(dirname(dirname(__DIR__)) . '/web/metronic/form-customer/account.details.php');
        $formContent->addElement(':formAccountDetails', $account);

        $profile = new Element($data[\Account\UserData::class]->profileData());
        $profile->require(dirname(dirname(__DIR__)) . '/web/metronic/form-customer/profile.details.php');
        $formContent->addElement(':formProfileDetails', $profile);

        $billing = new Element($data[\Payment\CreditCardData::class]);
        $billing->require(dirname(dirname(__DIR__)) . '/web/metronic/form-customer/billing.details.php');
        $formContent->addElement(':formBillingDetails', $billing);

        $confirm = new Element($data[\Account\UserData::class]);
        $confirm->require(dirname(dirname(__DIR__)) . '/web/metronic/form-customer/confirm.details.php');
        $formContent->addElement(':confirmDetails', $confirm);

        return $formContent;
    }

    /**
     * @param $data
     * @return \Html\Element
     */
    public static function list(array $data)
    {
        $userProfileData = new Element($data[\Account\UserProfileData::class]);
        $userProfileData->require(dirname(dirname(__DIR__)) . '/web/metronic/table-customer/list.php');

        return $userProfileData;
    }
}