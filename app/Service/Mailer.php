<?php


namespace App\Service;


use Mail\EmailCommand;

class Mailer implements \App\Spec\Main
{
    /**
     * Operations holding callable
     *
     * @var \Closure
     */
    private $callback;

    public function __construct(\Closure $callback)
    {
        $this->callback = $callback;
    }

    public function invoke()
    {
        return call_user_func($this->callback);
    }

    /**
     * @param EmailCommand $eMailCommand
     * @return EmailReturnValue
     */
    public function dispatch(EmailCommand $eMailCommand)
    {
        /** @var \App\Service\ORM $doctrine */
        $doctrine = new ORM();
        $entityManager = $doctrine->entityManager();

        $returnValue = new EmailReturnValue();

        try {
            // when duplicate, then return early
            $entityManager->persist($eMailCommand);
            $entityManager->flush();

        } catch (\Exception $exception) {

            $returnValue->addFailureError(get_class($eMailCommand));
            if (strpos($exception->getMessage(), '1062 Duplicate entry') !== false) {
                $returnValue->addFailureError('eMail was already sent');
            }
            $returnValue->addFailureError($exception->getMessage());
            return $returnValue;
        }

        $mailer = new \Mail\Mailer($eMailCommand);

        if($mailer->handle()){
            $returnValue->addSucceedMessage(get_class($eMailCommand));
        } else {
            $returnValue->addFailureError(get_class($eMailCommand));
        }

        return $returnValue;
    }
}