<?php


namespace View;


class Customer
{
    /**
     * @param array $data
     * @return \Html\Element
     */
    public static function form(array $data)
    {
        $formContent = new \Html\Element($data['userData']);
        $formContent->require('../web/metronic/form-customer/form.php');

        $account = new \Html\Element($data['userData']);
        $account->require('../web/metronic/form-customer/account.details.php');
        $formContent->addElement(':formAccountDetails', $account);

        $profile = new \Html\Element($data['userProfileData']);
        $profile->require('../web/metronic/form-customer/profile.details.php');
        $formContent->addElement(':formProfileDetails', $profile);

        $billing = new \Html\Element($data['creditCardData']);
        $billing->require('../web/metronic/form-customer/billing.details.php');
        $formContent->addElement(':formBillingDetails', $billing);

        $confirm = new \Html\Element($data['userData']);
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
        $userProfileData = new \Html\Element($data);
        $userProfileData->require('../web/metronic/table-customer/list.php');

        return $userProfileData;
    }
}