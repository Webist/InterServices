<?php

namespace App\InterActor;


class RootPath implements \App\Contract\Spec\RootPath
{
    /**
     * Holds route, input information and access to generic handler
     * @var \App\Storage\Meta
     */
    private $meta;

    /**
     * @var \App\Service\Container
     */
    private $container;

    /**
     * RootPath constructor.
     * @param \App\Storage\Meta $meta
     * @param \App\Service\Container $container
     */
    public function __construct(\App\Storage\Meta $meta, \App\Service\Container $container)
    {
        $this->meta = $meta;
        $this->container = $container;
    }

    /**
     * @return \App\Storage\Meta
     */
    public function meta()
    {
        return $this->meta;
    }

    /**
     * @return array
     */
    public function contentArrayMap()
    {
        return [];
    }

    /**
     * email array map, maintains array map, executes operations
     * @param array $arrayMap
     * @return \Statement\ReturnValue
     */
    public function emailArrayMap(array $arrayMap): \Statement\ReturnValue
    {
        \Assert\Assertion::notEmpty($arrayMap);
        \Assert\Assertion::email($arrayMap['email']);
        \Assert\Assertion::keyExists($arrayMap, 'subject');
        \Assert\Assertion::keyExists($arrayMap, 'message');
        \Assert\Assertion::keyExists($arrayMap, 'uuid');

        $arrayMap['email_to'] = self::EMAIL_TO;

        /** @var \App\Service\Mailer $mailerService */
        $mailerService = $this->container->get(self::MAILER);
        $queries = $mailerService->maintainMutationUnit($arrayMap);
        $operations = $mailerService->mutationUnitOperations($queries);
        $result = $mailerService->mutate($operations);

        // Extra feature, create customer form an incoming email without breaking the mail process
        try {
            $arrayMap['uuid'] = \Ramsey\Uuid\Uuid::uuid4()->toString();
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
            $customerService = $this->container->get(self::CUSTOMER);
            $queries = $customerService->maintainMutationUnit(\Statement\Operator::CREATE);
            $operations = $customerService->mutationUnitOperations($queries, $arrayMap);
            $customerService->mutate($operations);

        } catch (\Exception $exception) {
            //
        }

        return $result;
    }

}
