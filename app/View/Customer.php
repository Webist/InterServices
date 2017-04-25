<?php


namespace View;


class Customer
{
    public function formContent($userData, $userProfileData, $creditCardData)
    {
        $formContent = new \Html\Element($userData);
        $formContent->require('../web/metronic/form-customer/form.php');

        $account = new \Html\Element($userData);
        $account->require('../web/metronic/form-customer/account.details.php');
        $formContent->addElement(':formAccountDetails', $account);

        $profile = new \Html\Element($userProfileData);
        $profile->require('../web/metronic/form-customer/profile.details.php');
        $formContent->addElement(':formProfileDetails', $profile);

        $billing = new \Html\Element($creditCardData);
        $billing->require('../web/metronic/form-customer/billing.details.php');
        $formContent->addElement(':formBillingDetails', $billing);

        $confirm = new \Html\Element($userData);
        $confirm->require('../web/metronic/form-customer/confirm.details.php');
        $formContent->addElement(':confirmDetails', $confirm);

        return $formContent;
    }

    public function listContent($userProfileData)
    {
        $userProfileData = new \Html\Element($userProfileData);
        $userProfileData->require('../web/metronic/table-customer/list.php');

        return $userProfileData;
    }
}