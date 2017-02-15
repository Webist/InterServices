<?php
/**
 * Info
 * Created: 09/02/2017 22:59
 *
 *
 * A Visitor should be able to register as new Commerce
 * A system manager should be able to register a new Commerce
 *
 *
 * Commerce is een Entity.
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

    public function get()
    {

        $postData = array (
            'username' => 'John707',
            'password' => '12345',
            'rpassword' => '12345',
            'email' => 'test@example.com',
            'fullname' => 'John Doe',

            'phone' => '0600000000',
            'gender' => 'M',
            'address' => 'Teststreet 38',
            'city' => 'Eindhoven',
            'country' => 'NL',
            'remarks' => 'Remarks',
            'card_name' => 'J DOE',
            'card_number' => '1111111111111111',
            'card_cvc' => '383',
            'card_expiry_date' => '11/2020',
            'payment' =>
                array (
                    0 => '1',
                    1 => '2',
                ),
        );


        if(isset($_GET['uuid'])) {
            // /customer?uuid=db914168-f773-4bba-86b5-2b4d281e59ef
            $uuid = $_GET['uuid'];
        } else {
            $uuid4 = \Ramsey\Uuid\Uuid::uuid4();
            $uuid = $uuid4->toString();
        }

        $postData = array_merge($postData, ['uuid' => $uuid]);

        /** @var \Commerce\Customer $customerService */
        $customerService = $this->handler->service(self::CUSTOMER);

        $operations = $this->handler->buildOperations($postData);

        $customerService->handle();

        //print '<pre>';
        //print_r($operations);

    }
}
