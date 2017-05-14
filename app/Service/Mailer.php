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
     * Maintains the post xhr data request
     *
     * A request, as an intent, goes trough strategical process.
     * It will be validated, sanitized, planned (prioritized),
     * policies applied (such as bad word policy),
     * converted to internal language
     * and (partly or whole) accepted or rejected.
     *
     * @param array $postData
     */
    public function maintainLifeCyclePostXhrData(array $postData)
    {
        \Assert\Assertion::notEmpty($postData);
        \Assert\Assertion::email($postData['email']);

        \Assert\Assertion::keyExists($postData, 'subject');
        \Assert\Assertion::keyExists($postData, 'message');

        if (empty($postData['uuid'])) {
            $postData['uuid'] = uniqid();
        }
        $uuid = $postData['uuid'];

        $authorize = new \Mail\Authorize($postData['email']);

        $this->queries[\Mail\Authorize::class] = $authorize;

        $emailData = new \Mail\EmailData($uuid);
        $emailData->setSender($postData['email']);
        $emailData->setReceiver($postData['email_to']);
        $emailData->setSubject($postData['subject']);
        $emailData->setMessage($postData['message']);
        $emailData->setHeaders('From: ' . $postData['email'] . "\r\n" .
            'Replay-to: ' . $postData['email'] . "\r\n" .
            'X-Mailer: PHP/' . phpversion());

        $this->queries[\Mail\EmailData::class] = $emailData;

        // Extra feature, create customer form an incoming email
        $customerService = new \App\Service\Customer();

        $postData['uuid'] = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $postData['username'] = '';
        $postData['password'] = '';
        $postData['gender'] = 0;
        $postData['fullname'] = $postData['name'];
        $postData['email'] = $postData['email'];
        $postData['address'] = '';
        $postData['zipcode'] = '';
        $postData['city'] = '';
        $postData['country'] = '';
        $postData['remarks'] = "Created by eMail\r\n post uuid\r\n" . $uuid . "\r\n subject\r\n" . $postData['subject'] . "\r\n message\r\n" . $postData['message'];
        $postData['card_name'] = '';
        $postData['card_cvc'] = '';
        $postData['card_expiry_date'] = '';
        $postData['card_number'] = '';

        $customerService->maintainLifeCyclePostXhrData($postData);

        $this->queries[\App\Service\Customer::class] = $customerService;
    }

    /**
     * Sets operations cycle post xhr data
     *
     */
    public function setLifeCyclePostXhrData()
    {
        // Validate data
        $this->operations[\Mail\Authorize::class] = $this->queries[\Mail\Authorize::class];

        // Save into database
        $this->operations[\Mail\Email::class] = new \Mail\Email($this->queries[\Mail\Authorize::class], $this->orm());

        // Send mail
        $this->operations[\Mail\EmailSend::class] = new \Mail\EmailSend($this->queries[\Mail\Authorize::class]);

        // Extra feature, create customer form an incoming email
        /** @var \App\Service\Customer $customerService */
        $customerService = $this->queries[\App\Service\Customer::class];
        $customerService->setLifeCyclePostXhrData();

        foreach ($this->queries[\App\Service\Customer::class]->operations() as $operation) {
            $this->operations[get_class($operation)] = $operation;
        }
    }

    private function orm()
    {
        if ($this->orm === null) {
            $this->orm = new \App\Service\ORM();
        }
        return $this->orm;
    }

    public function dispatch()
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