<?php


namespace App\Service;


class Mailer
{
    private $orm;
    private $queries = [];
    private $operations = [];

    public function queries()
    {
        return $this->queries;
    }

    public function operations()
    {
        return $this->operations;
    }

    /**
     * Maintain array map, build queries array, lifeCycle
     *
     * Maintaining the lifeCycle of a request, as an intent, goes trough strategical process.
     * It will be validated, sanitized, planned (prioritized),
     * policies applied (such as bad word policy),
     * eventually converted to internal language
     * and (partly or whole) accepted or rejected.
     *
     * @param array $arrayMap
     * @return bool
     */
    public function maintainArrayMap(array $arrayMap): bool
    {
        \Assert\Assertion::notEmpty($arrayMap);
        \Assert\Assertion::email($arrayMap['email']);

        \Assert\Assertion::keyExists($arrayMap, 'subject');
        \Assert\Assertion::keyExists($arrayMap, 'message');

        if (empty($arrayMap['uuid'])) {
            $arrayMap['uuid'] = uniqid();
        }
        $uuid = $arrayMap['uuid'];

        $this->queries[\Mail\Authorize::class] = new \Mail\Authorize($arrayMap['email']);

        $emailData = new \Mail\EmailData($uuid);
        $emailData->setSender($arrayMap['email']);
        $emailData->setReceiver($arrayMap['email_to']);
        $emailData->setSubject($arrayMap['subject']);
        $emailData->setMessage($arrayMap['message']);
        $emailData->setHeaders('From: ' . $arrayMap['email'] . "\r\n" .
            'Replay-to: ' . $arrayMap['email'] . "\r\n" .
            'X-Mailer: PHP/' . phpversion());

        $this->queries[\Mail\EmailData::class] = $emailData;

        // Extra feature, create customer form an incoming email
        $customerService = new \App\Service\Customer();

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
        $arrayMap['remarks'] = "Created by eMail\r\n post uuid\r\n" . $uuid . "\r\n subject\r\n" . $arrayMap['subject'] . "\r\n message\r\n" . $arrayMap['message'];
        $arrayMap['card_name'] = '';
        $arrayMap['card_cvc'] = '';
        $arrayMap['card_expiry_date'] = '';
        $arrayMap['card_number'] = '';

        $customerService->maintainArrayMap($arrayMap);

        $this->queries[\App\Service\Customer::class] = $customerService;
        return true;
    }

    /**
     * Set operations, build operations array, lifeCycle
     * @return bool
     * @throws \Exception
     */
    public function setArrayMapOperations()
    {
        if (empty($this->queries)) {
            throw new \Exception('Array Map Operations not allowed before maintain Array Map');
        }

        // Validate data
        $this->operations[\Mail\Authorize::class] = $this->queries[\Mail\Authorize::class];

        // Save into database
        $this->operations[\Mail\Email::class] = new \Mail\Email($this->queries[\Mail\Authorize::class], $this->orm());

        // Send mail
        $this->operations[\Mail\EmailSend::class] = new \Mail\EmailSend($this->queries[\Mail\Authorize::class]);

        // Extra feature, create customer form an incoming email
        /** @var \App\Service\Customer $customerService */
        $customerService = $this->queries[\App\Service\Customer::class];
        $customerService->setArrayMapOperations();

        foreach ($this->queries[\App\Service\Customer::class]->operations() as $operation) {
            $this->operations[get_class($operation)] = $operation;
        }

        return true;
    }

    private function orm()
    {
        if ($this->orm === null) {
            $this->orm = new \App\Service\ORM();
        }
        return $this->orm;
    }

    /**
     * @return \Mail\ReturnValue
     */
    public function execute()
    {
        $returnValue = new \Mail\ReturnValue();

        foreach ($this->operations as $operation => $statement) {

            if (!$statement->execute()) {
                $returnValue->addFailureError($operation);
            } else {
                $returnValue->addSucceedMessage($operation);
            }
        }

        return $returnValue;
    }
}