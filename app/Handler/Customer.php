<?php
/**
 * Info
 * Created: 13/02/2017 20:58
 *
 */

namespace App\Handler;


class Customer extends AbstractHandler
{

    public function buildOperations($postData)
    {
        $operations = [];

        // Create/Update User
        $userInput = new \Account\UserInput($postData['uuid']);
        $userInput->setFullname($postData['fullname']);
        $userInput->setPasswd($postData['password']);
        $userInput->setRpasswd($postData['rpassword']);
        $userInput->setUsername($postData['username']);

        $operations[] = $user = new \Account\User($userInput);

        // Create/Update Profile
        $userProfileInput = new \Account\UserProfileInput($postData['uuid']);
        $userProfileInput->setAddress($postData['address']);
        $userProfileInput->setCity($postData['city']);
        $userProfileInput->setCountry($postData['country']);
        $userProfileInput->setGender($postData['gender']);
        $userProfileInput->setPhone($postData['phone']);

        $userProfileInput->setRemarks($postData['remarks']);

        // Create update Credit-card info
        $creditCardInput = new \Payment\CreditCardInput($postData['uuid']);
        $creditCardInput->setName($postData['card_name']);
        $creditCardInput->setCvc($postData['card_number']);
        $creditCardInput->setExpiryDate($postData['card_cvc']);
        $creditCardInput->setNumber($postData['card_expiry_date']);

        // Credit-card payment preference
        $operations[] = $creditCard = new \Payment\CreditCard($creditCardInput);
        $creditCard->isAutopay($postData['payment'][1]);

        $userProfileInput->setCreditCard($creditCard); // should be only id link.

        $operations[] = $userProfile = new \Account\UserProfile($userProfileInput);

        // Notification-schedule billing
        $operations[] = $billingNotify = new \Notify\BillingSchedule($postData['uuid']);
        $billingNotify->setSchedule(\Notify\BillingScheduleSpec::MONTHLY);
        $billingNotify->handle();
        
        return $operations;
    }

}