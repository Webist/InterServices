<?php


namespace App\Service;


/**
 *
 * Domain-centric domain service.
 * This means communications are with a persistence layer.
 * Model and relations live in application via object orchestration.
 *
 * LifeCycle of units
 *
 * Maintaining the lifeCycle of a request, as an intent, goes trough strategical process.
 * It will be validated, sanitized, planned (prioritized),
 * policies applied (such as bad word policy),
 * eventually converted to internal language
 * and (partly or whole) accepted or rejected.
 *
 * Class Mailer
 * @package App\Service
 */
class Mailer
{

    private $operator;
    /** In context mutate, when a new record needed to be created */
    const OPERATOR_PERSIST = \Statement\Operation::PERSIST;

    private $orm;

    /**
     * @return ORM
     */
    private function orm()
    {
        if ($this->orm === null) {
            $this->orm = new \Connector\ORM();
        }
        return $this->orm;
    }

    /**
     * Maintain array map, build queries array, lifeCycle
     *
     * @param array $arrayMap
     * @return array
     */

    /**
     * @param $operator
     * @return array
     */
    public function maintainReturnValueUnit($operator): array
    {
        $this->operator = $operator;
        $queries = [];
        $queries[\Mail\EmailAuthorize::class] = new \Mail\EmailAuthorize();
        $queries[\Mail\EmailData::class] = new \Mail\EmailData();
        return $queries;
    }

    /**
     * @param array $queries
     * @param array $arrayMap
     * @return array
     */
    public function returnValueOperations(array $queries, array $arrayMap): array
    {
        $operations = [];

        $authorize = $queries[\Mail\EmailAuthorize::class];
        $authorize->setEmail($arrayMap['email']);

        $operations[\Mail\EmailAuthorize::class] = $authorize;

        /** @var \Mail\EmailData $emailData */
        $emailData = $queries[\Mail\EmailData::class];
        $emailData->setId($arrayMap['uuid']);
        $emailData->setSender($arrayMap['email']);
        $emailData->setReceiver($arrayMap['email_to']);
        $emailData->setSubject($arrayMap['subject']);
        $emailData->setMessage($arrayMap['message']);
        $emailData->setHeaders('From: ' . $arrayMap['email'] . "\r\n" .
            'Replay-to: ' . $arrayMap['email'] . "\r\n" .
            'X-Mailer: PHP/' . phpversion());

        /** @var \Mail\EmailData $query */
        foreach ($queries as $classString => $query) {

            if ($classString == \Mail\EmailData::class) {

                if (empty($query->getId())) {
                    $query->setId(uniqid());
                }
                // Save into database
                $operations[\Mail\EmailData::class] = new \Statement\Operation($query, \Statement\Operation::PERSIST, $this->orm());
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

        /** @var \Statement\Operation $operation */
        foreach ($operations as $operation => $operation) {

            if (!$operation->execute()) {
                $returnValue->addFailureError($operation);
            } else {
                $returnValue->addSucceedMessage($operation);
            }
            $returnValue->setUuid($operation->data()->getId());
        }

        return $returnValue;
    }
}