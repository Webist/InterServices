<?php


namespace App\Contract\Action;


/**
 *
 * Class Customer
 * @package App\Action
 */
class Customer implements \App\Contract\Spec\Customer
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function assertPostXhrData()
    {
        \Assert\Assertion::keyExists($this->postData, 'uuid');
        \Assert\Assertion::email($this->postData['email']);

        return $this->data;
    }
}