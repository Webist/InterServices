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
    const OPERATOR_PERSIST = \Statement\Operator::PERSIST;

    const EMAIL_TO = 'info@example.com';

    /**
     * @param $operator
     * @return $this
     */
    private function operator($operator)
    {
        $this->operator = $operator;
        return $this;
    }

    private function returnValueUnit()
    {
        $unit = [];
        $unit[\Mail\EmailAuthorize::class] = new \Mail\EmailAuthorize();
        $unit[\Mail\EmailData::class] = new \Mail\EmailData();
        return $unit;
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
    public function maintainReturnValue($operator): array
    {
        return $this->operator($operator)->returnValueUnit();
    }

    /**
     * @param array $queries
     * @param array $arrayMap
     * @return array
     */
    public function returnValueOperators(array $queries, array $arrayMap): array
    {
        $operators = [];

        $authorize = $queries[\Mail\EmailAuthorize::class];
        $authorize->setEmail($arrayMap['email']);

        // Validate email
        $operators[\Mail\EmailAuthorize::class] = $authorize;

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
                $operators[\Mail\EmailData::class] = new \Statement\Operator($query, \Statement\Operator::PERSIST);
                // Send mail
                $operators[\Mail\EmailSend::class] = new \Mail\EmailSend($query);
            }

        }
        return $operators;
    }
}