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


class Customer implements \App\Spec\Customer
{

    private $inputHandler; // customer input = User object. dus dit kan helemaal niet Commerce zijn.
    private $handler; // dit is de Commerce object ? $customerHandler->register($u);

    public function __construct(InputHandler $inputHandler, \App\Handler\Customer $handler)
    {
        $this->inputHandler = $inputHandler;
        $this->handler = $handler;
        
    }

    public function register()
    {
        // https://www.clever-cloud.com/blog/engineering/2015/05/20/why-auto-increment-is-a-terrible-idea/
        // @todo e-mail <=> user is already in use.
        // @todo een user zonder e-mail moet mogelijk zijn. creeer uuid https://github.com/ramsey/uuid

        $postData = array (
            'username' => 'Webist',
            'password' => '12345',
            'rpassword' => '12345',
            'email' => 'fethibey@gmail.com',
            'fullname' => 'Fethi Kus',
            'phone' => '0600000000',
            'gender' => 'M',
            'address' => 'Harpstraat 38',
            'city' => 'Eindhoven',
            'country' => 'NL',
            'remarks' => 'Remarks',
            'card_name' => 'F KUS',
            'card_number' => '1111111111111111',
            'card_cvc' => '303',
            'card_expiry_date' => '11/2020',
            'payment' =>
                array (
                    0 => '1',
                    1 => '2',
                ),
        );


        // self::Commerce, should be the reference object to fill values into it.

        /** @var \Commerce\Customer $customer */
        $customer = $this->handler->service(self::CUSTOMER);
        $customer->input($postData);
        print_r($customer);


        // fill postData into the reference object (entity). In other words entity to value obj.
        // $customer->data($postData);

        //$id = $customer->register();


        // optionally?, register also as user (eMail is unique).

        // event register, shell_exec / RabbitMQ

        //



    }
}
