<?php


namespace App\Service;


class Mailer
{
    private $orm;

    private $operations;

    public function emailPostXhrOperations(\App\Event\MailerStatement $operation)
    {
        $operation->emailPostXhrReacts(null, $this);
    }

    public function applyReact($key, $react)
    {
        $this->operations[$key] = $react;
    }

    /**
     * @return \App\ReturnValue\Email
     */
    public function dispatch()
    {
        $returnValue = new \App\ReturnValue\Email();

        /** @var \Mail\Mailer $operation */
        foreach ($this->operations as $operation) {

            $class = $operation->data();
            $className = get_class($operation->data());

            try {
                $this->orm()->entityManager()->persist($class);
                $this->orm()->entityManager()->flush();
            } catch (\Exception $exception) {

                $returnValue->addFailureError($className);
                if (strpos($exception->getMessage(), '1062 Duplicate entry') !== false) {
                    $returnValue->addFailureError('eMail was already sent');
                }
                $returnValue->addFailureError($exception->getMessage());
                return $returnValue;
            }
            $returnValue->setUuid($operation->uuid());

            if ($operation->execute()) {
                $returnValue->addSucceedMessage($className);
            } else {
                $returnValue->addFailureError($className);
            }
        }

        return $returnValue;
    }

    public function orm()
    {
        if ($this->orm === null) {
            $this->orm = new \App\Service\ORM();
        }
        return $this->orm;
    }
}