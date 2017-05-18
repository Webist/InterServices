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
    public function maintainMutationMap(array $arrayMap): bool
    {
        \Assert\Assertion::notEmpty($arrayMap);
        \Assert\Assertion::email($arrayMap['email']);

        \Assert\Assertion::keyExists($arrayMap, 'subject');
        \Assert\Assertion::keyExists($arrayMap, 'message');

        if (empty($arrayMap['uuid'])) {
            $arrayMap['uuid'] = uniqid();
        }
        $uuid = $arrayMap['uuid'];

        $emailData = new \Mail\EmailData($uuid);
        $emailData->setSender($arrayMap['email']);
        $emailData->setReceiver($arrayMap['email_to']);
        $emailData->setSubject($arrayMap['subject']);
        $emailData->setMessage($arrayMap['message']);
        $emailData->setHeaders('From: ' . $arrayMap['email'] . "\r\n" .
            'Replay-to: ' . $arrayMap['email'] . "\r\n" .
            'X-Mailer: PHP/' . phpversion());

        // Validate data
        $this->operations[\Mail\Authorize::class] = new \Mail\Authorize($arrayMap['email']);
        // Save into database
        $this->operations[\Mail\Email::class] = new \Statement\Operator($emailData, $this->orm());
        // Send mail
        $this->operations[\Mail\EmailSend::class] = new \Mail\EmailSend($emailData);

        return $this->operations;
    }

    private function orm()
    {
        if ($this->orm === null) {
            $this->orm = new \App\Service\ORM();
        }
        return $this->orm;
    }

    /**
     * Set operations, build operations array, lifeCycle
     * @param array $operations
     * @return \Statement\ReturnValue
     */
    public function mutate(array $operations)
    {
        $returnValue = new \Statement\ReturnValue();

        /** @var \Statement\Operator $statement */
        foreach ($operations as $operation => $statement) {

            if (!$statement->execute()) {
                $returnValue->addFailureError($operation);
            } else {
                $returnValue->addSucceedMessage($operation);
            }
            $returnValue->setUuid($statement->data()->getId());
        }

        return $returnValue;
    }
}