<?php


namespace App\Service;


class Mailer
{
    private $orm;

    /**
     * @return ORM
     */
    private function orm()
    {
        if ($this->orm === null) {
            $this->orm = new \App\Service\ORM();
        }
        return $this->orm;
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
     * @return array
     */
    public function maintainMutationMap(array $arrayMap): array
    {
        $queries = [];
        // Validate data
        $queries[\Mail\EmailAuthorize::class] = new \Mail\EmailAuthorize($arrayMap['email']);

        $emailData = new \Mail\EmailData($arrayMap['uuid']);
        $emailData->setSender($arrayMap['email']);
        $emailData->setReceiver($arrayMap['email_to']);
        $emailData->setSubject($arrayMap['subject']);
        $emailData->setMessage($arrayMap['message']);
        $emailData->setHeaders('From: ' . $arrayMap['email'] . "\r\n" .
            'Replay-to: ' . $arrayMap['email'] . "\r\n" .
            'X-Mailer: PHP/' . phpversion());

        $queries[\Mail\EmailData::class] = $emailData;

        return $queries;
    }

    /**
     * @param array $queries
     * @return array
     */
    public function prepareOperations(array $queries): array
    {
        $operations = [];
        $uuid = uniqid();
        /** @var \Mail\EmailData $query */
        foreach ($queries as $classString => $query) {

            if ($classString == \Mail\EmailData::class) {

                if (empty($query->getId())) {
                    $query->setId($uuid);
                }
                // Save into database
                $operations[\Mail\EmailData::class] = new \Statement\Operator($query, \Statement\Operator::CREATE, $this->orm());
                // Send mail
                $operations[\Mail\EmailSend::class] = new \Mail\EmailSend($query);
            }
        }
        return $operations;
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