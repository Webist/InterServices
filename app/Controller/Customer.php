<?php

namespace App\Controller;


class Customer implements \App\Contract\Spec\Customer
{
    private $inputHandler;
    private $interActor;

    public function __construct(\Http\Stream\InputHandler $inputHandler, \App\InterActor\Customer $interActor)
    {
        $this->inputHandler = $inputHandler;
        $this->interActor = $interActor;
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
        // return $this->renderForm();
        throw new \Error(var_dump($this->interActor->postXhrReturnValue($postData)));
    }

    /**
     * Entry point post xhr request, adds Post Xhr, confirmation message
     * @return string
     */
    public function addPostXhr()
    {
        $returnValue = $this->interActor->postXhrReturnValue(filter_input_array(INPUT_POST));

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
     * Entry point form request, renders Form, html data
     * @return string
     */
    public function renderForm()
    {
        $formUnit = $this->interActor->formUnit($this->inputHandler->parameter('uuid'));

        $view = new \View\Model(
            \View\Customer::form($formUnit),
            $this->interActor->meta()->routeArrayMap()
        );
        return $view->render();
    }

    /**
     * Entry point list request, renders List, html data
     * @return string
     */
    public function renderList()
    {
        $listUnit = $this->interActor->listUnit();

        $view = new \View\Model(
            \View\Customer::list($listUnit),
            $this->interActor->meta()->routeArrayMap()
        );
        return $view->render();
    }
}
