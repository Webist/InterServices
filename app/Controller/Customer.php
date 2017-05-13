<?php

namespace App\Controller;

use Http\Stream\InputHandler;

class Customer implements \App\Contract\Spec\Customer
{
    private $inputHandler;
    private $handler;

    public function __construct(InputHandler $inputHandler, \App\InterActor\Customer $handler)
    {
        $this->inputHandler = $inputHandler;
        $this->handler = $handler;
    }

    public function test()
    {
        print 'Test the CustomerStatement data save into storage <br/>';

        $postData = array(
            'uuid' => 'ce27bcce-f0c0-4f60-8479-52ef2e41b4f4',

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

        $this->handler->postXhrData($postData);
    }

    /**
     * Entry point Customer post xhr request, adds Customer Post Xhr, confirmation message
     * @return string
     */
    public function addPostXhr()
    {
        $returnValue = $this->handler->postXhrData(
            filter_input_array(INPUT_POST));

        return json_encode(
            [
                self::CONFIRMATION_MESSAGE_KEY => $returnValue->state(),
                'state' => ['title' => 'Customer', 'url' => ''],
                'uuid' => $returnValue->uuid(),
                'data' => [
                    'succeeds' => $returnValue->getSucceedMessages(),
                    'errors' => $returnValue->getFailureErrors()
                ]
            ]
        );
    }

    /**
     * Entry point Customer form request, renders Form, html data
     * @return mixed|string
     */
    public function renderForm()
    {
        $formData = $this->handler->formData($this->inputHandler->parameter('uuid'));

        $view = new \View\Model(
            \View\Customer::form($formData),
            $this->handler->meta()->modelMetaData()
        );
        return $view->render();
    }

    /**
     * Entry point Customer list request, renders List, html data
     * @return mixed|string
     */
    public function renderList()
    {
        $view = new \View\Model(
            \View\Customer::list($this->handler->listData()),
            $this->handler->meta()->modelMetaData()
        );
        return $view->render();
    }
}
