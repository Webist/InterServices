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
        $formContent = new Element($data['userData']);
        $formContent->require('../web/metronic/form-customer/form.php');

        $account = new Element($data['userData']);
        $account->require('../web/metronic/form-customer/account.details.php');
        $formContent->addElement(':formAccountDetails', $account);

        $profile = new Element($data['userData']->profileData());
        $profile->require('../web/metronic/form-customer/profile.details.php');
        $formContent->addElement(':formProfileDetails', $profile);

        $billing = new Element($data['creditCardData']);
        $billing->require('../web/metronic/form-customer/billing.details.php');
        $formContent->addElement(':formBillingDetails', $billing);

        $confirm = new Element($data['userData']);
        $confirm->require('../web/metronic/form-customer/confirm.details.php');
        $formContent->addElement(':confirmDetails', $confirm);

        return $formContent;
    }

    /**
     * @param $data
     * @return \Html\Element
     */
    public static function list(array $data)
    {
        $userProfileData = new Element($data);
        $userProfileData->require('../web/metronic/table-customer/list.php');

        return $userProfileData;
    }
}