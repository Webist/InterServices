<?php

namespace App\InterActor;


use App\Service\App;

class RootPath implements \App\Contract\Spec\RootPath, \App\Contract\Behave\InterActor
{
    /**
     * @var App
     */
    private $app;

    /**
     * RootPath constructor.
     * @param App $app
     */
    public function __construct(\App\Service\App $app)
    {
        $this->app = $app;
    }

    public function app()
    {
        return $this->app;
    }

    /**
     * @return array
     */
    public function contentUnit()
    {
        return [];
    }

    /**
     * Email, maintains array map and defines operation, dispatches operations
     * @param array $arrayMap
     * @return \Statement\ReturnValue
     */
    public function emailReturnValue(array $arrayMap): \Statement\ReturnValue
    {
        \Assert\Assertion::notEmpty($arrayMap);
        \Assert\Assertion::email($arrayMap['email']);
        \Assert\Assertion::keyExists($arrayMap, 'subject');
        \Assert\Assertion::keyExists($arrayMap, 'message');
        \Assert\Assertion::keyExists($arrayMap, 'uuid');

        /** @var \App\Service\Mailer $mailerService */
        $mailerService = $this->app->get(self::MAILER);

        $arrayMap['email_to'] = $mailerService::EMAIL_TO;

        $queries = $mailerService->maintainReturnValue($mailerService::OPERATOR_PERSIST);
        $operators = $mailerService->returnValueOperators($queries, $arrayMap);

        $operations = new \Statement\Operations($operators, new \Statement\ReturnValue());
        $result = $operations->execute();

        // Extra feature, create customer form an incoming email without breaking the mail process
        try {
            $arrayMap['uuid'] = uniqid();
            $arrayMap['username'] = '';
            $arrayMap['password'] = '';
            $arrayMap['gender'] = 0;
            $arrayMap['fullname'] = $arrayMap['name'];
            // $arrayMap['email'] = $arrayMap['email'];
            $arrayMap['address'] = '';
            $arrayMap['zipcode'] = '';
            $arrayMap['city'] = '';
            $arrayMap['country'] = '';
            $arrayMap['remarks'] = "Created by eMail\r\n post uuid\r\n" . $result->uuid() . "\r\n subject\r\n" . $arrayMap['subject'] . "\r\n message\r\n" . $arrayMap['message'];
            $arrayMap['card_name'] = '';
            $arrayMap['card_cvc'] = '';
            $arrayMap['card_expiry_date'] = '';
            $arrayMap['card_number'] = '';

            /** @var \App\Service\Customer $customerService */
            $customerService = $this->app->get(self::CUSTOMER);
            $customerService->maintainReturnValue($customerService::OPERATOR_PERSIST);
            $operators = $customerService->returnValueOperators($arrayMap);

            $operations = new \Statement\Operations($operators, new \Statement\ReturnValue());
            $operations->execute();

        } catch (\Exception $exception) {
            //
        }

        return $result;
    }

}
