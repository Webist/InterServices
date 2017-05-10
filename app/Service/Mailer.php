<?php


namespace App\Service;


class Mailer
{
    private $orm;
    private $operations = [];

    public function operations()
    {
        return $this->operations;
    }

    /**
     * Sets operations cycle post xhr data
     * @param array $postData
     */
    public function setLifeCyclePostXhrData(array $postData)
    {
        if (empty($postData['uuid'])) {
            $postData['uuid'] = uniqid();
        }
        $uuid = $postData['uuid'];

        $authorize = new \Mail\Authorize($postData['email']);
        $this->operations[\Mail\Authorize::class] = $authorize;


        $emailData = new \Mail\EmailData($uuid);
        $emailData->setSender($postData['email']);
        $emailData->setReceiver($postData['email_to']);
        $emailData->setSubject($postData['subject']);
        $emailData->setMessage($postData['message']);
        $emailData->setHeaders('From: ' . $postData['email'] . "\r\n" .
            'Replay-to: ' . $postData['email'] . "\r\n" .
            'X-Mailer: PHP/' . phpversion());

        $email = new \Mail\Email($emailData, $this->orm());
        $this->operations[\Mail\Email::class] = $email;


        $emailSend = new \Mail\EmailSend($emailData);
        $this->operations[\Mail\EmailSend::class] = $emailSend;

        //-----------------
        $customerService = new \App\Service\Customer();

        $postData['uuid'] = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $postData['username'] = '';
        $postData['password'] = '';
        $postData['gender'] = 0;
        $postData['fullname'] = $postData['name'];
        $postData['email'] = $emailData->getSender();
        $postData['address'] = '';
        $postData['zipcode'] = '';
        $postData['city'] = '';
        $postData['country'] = '';
        $postData['remarks'] = "Created by eMail\r\n post uuid\r\n" . $uuid . "\r\n subject\r\n" . $postData['subject'] . "\r\n message\r\n" . $postData['message'];
        $postData['card_name'] = '';
        $postData['card_cvc'] = '';
        $postData['card_expiry_date'] = '';
        $postData['card_number'] = '';

        $customerService->setLifeCyclePostXhrData($postData);

        // customerService has no execute!,
        foreach ($customerService->operations() as $operation) {
            $this->operations[get_class($operation)] = $operation;
        }
    }

    public function orm()
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