<?php


namespace App\ReturnValue;


class Email
{
    private $failureErrors = [];
    private $successMessages = [];

    private $state = true;

    private $uuid;

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

    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
    }

    public function uuid()
    {
        return $this->uuid;
    }
}