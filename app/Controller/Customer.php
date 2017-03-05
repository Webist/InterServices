<?php
/**
 *
 *
 * A Visitor should be able to Register as new Customer
 * A System Manager should be able to Register a new Customer
 *
 */

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
        print 'Test the Customer data save into storage <br/>';

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


        $uuid = $this->inputHandler->parameter('uuid');
        if (empty($uuid)) {
            $uuid = $this->handler->uuid();
        }

        // Prepare operations to callback by CustomerService
        $this->handler::buildOperations($postData, $uuid);

        // Reflect the customer service stateless in the global shared state with a callback
        /** @var \App\Service\Customer $customerService */
        $customerService = $this->handler->service(self::CUSTOMER, function () {
            return $this->handler::getOperations();
        });

        $customerService->handle();

    }

    public function postXhr()
    {
        $postData = filter_input_array(INPUT_POST);

        try {
            $uuid = $this->inputHandler->parameter('uuid');

            if (empty($uuid)) {
                $uuid = $this->handler->uuid();
            }

            // Prepare operations to callback by CustomerService
            $this->handler::buildOperations($postData, $uuid);

            // Reflect the customer service stateless in the global shared state with a callback
            /** @var \App\Service\Customer $customerService */
            $customerService = $this->handler->service(self::CUSTOMER, function () {
                return $this->handler::getOperations();
            });

            $customerService->handle();
            $message = [
                self::RESPONSE_MESSAGE_KEY => 'ok',
                'state' => ['title' => 'Customer form - Saved', 'url' => 'window.location.href'],
                'uuid' => $uuid
            ];

        } catch (\App\Exception\Customer $exception) {
            $message = [
                self::RESPONSE_MESSAGE_KEY => $exception->getMessage(),
                'state' => ['title' => 'Customer form - Failed', 'url' => 'window.location.href'],
                'uuid' => $uuid
            ];
        }

        return json_encode($message);
    }

    public function edit()
    {
        $uuid = $this->inputHandler->parameter('uuid');

        $lay = $this->handler->buildFormHtml($uuid);
        return $lay->render();
    }

    public function get()
    {
        $lay = $this->handler->buildListHtml();
        return $lay->render();

    }

}
