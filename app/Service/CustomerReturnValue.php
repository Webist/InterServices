<?php


namespace App\Service;


class CustomerReturnValue
{
    private $failureErrors = [];
    private $successMessages = [];

    private $state = true;

    public function addFailureError($message)
    {
        $this->failureErrors[] = $message;
        $this->state = false;
    }

    public function getFailureErrors()
    {
        return $this->failureErrors;
    }

    public function addSucceedMessage($message)
    {
        $this->successMessages[] = $message;
    }

    public function getSucceedMessages()
    {
        return $this->successMessages;
    }

    public function state()
    {
        return $this->state;
    }
}