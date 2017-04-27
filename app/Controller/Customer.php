<?php

namespace App\Controller;

use Http\Stream\InputHandler;

class Customer implements \App\Spec\Customer
{
    private $inputHandler;
    private $handler;

    public function __construct(InputHandler $inputHandler, \App\Handler\Customer $handler)
    {
        $this->inputHandler = $inputHandler;
        $this->handler = $handler;
    }

    public function test()
    {
        print 'Test the CustomerCommand data save into storage <br/>';

        $postData = array(

            'username' => 'John707',
            'password' => '12345',
            'rpassword' => '12345',

            'phone' => '0600000000',
            'email' => 'test@example.com',

            'gender' => 'M',
            'fullname' => 'John Doe',

            'address' => 'Teststreet 38',
            'zipcode' => '5642RB',
            'city' => 'Eindhoven',
            'country' => 'NL',

            'remarks' => 'Remarks',

            'card_name' => 'J DOE',
            'card_number' => '1111111111111111',
            'card_cvc' => '383',
            'card_expiry_date' => '11/2020',

            'payment' =>
                array(
                    0 => '1', // Auto-Pay with this Credit Card
                    1 => '2', // Email me monthly billing
                ),
        );

        $this->handler->postXhr($postData, $this->inputHandler->parameter('uuid'));
    }

    public function postXhr()
    {
        try {
            $this->handler->postXhr(
                filter_input_array(INPUT_POST),
                $this->inputHandler->parameter('uuid'));

            $message = [
                self::RESPONSE_MESSAGE_KEY => 'ok',
                'state' => ['title' => 'CustomerCommand form - Saved', 'url' => 'window.location.href'],
                'uuid' => $this->handler->main()->uuid()->toString()
            ];

        } catch (\App\Exception\Customer $exception) {
            $message = [
                self::RESPONSE_MESSAGE_KEY => $exception->getMessage(),
                'state' => ['title' => 'CustomerCommand form - Failed', 'url' => 'window.location.href'],
                'uuid' => $this->handler->main()->uuid()->toString()
            ];
        }

        return json_encode($message);
    }

    public function getForm()
    {
        $view = new \View\Model(
            \View\Customer::form($this->handler->form(
                $this->inputHandler->parameter('uuid'),
                self::CUSTOMER_EDIT)),
            $this->handler->main()->pageMetaData()
        );
        return $view->render();
    }

    public function getList()
    {
       $view = new \View\Model(
            \View\Customer::list($this->handler->list()),
            $this->handler->main()->pageMetaData()
        );
       return $view->render();
    }
}
