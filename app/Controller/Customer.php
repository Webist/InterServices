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

    /**
     * When post request-method uuid is empty then use the non empty uuid from get request-method
     * @param $postArrayMap
     * @return mixed
     */
    private function maintainUuid($postArrayMap)
    {
        if (array_key_exists('uuid', $postArrayMap) && empty($postArrayMap['uuid'])) {
            $getArrayMap = $this->inputHandler->getArrayMap();
            if (array_key_exists('uuid', $getArrayMap) && !empty($getArrayMap['uuid'])) {
                $postArrayMap['uuid'] = $getArrayMap['uuid'];
            }
        }
        return $postArrayMap;
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
        $postArrayMap = $this->maintainUuid($this->inputHandler->postArrayMap());

        $returnValue = $this->interActor->postXhrReturnValue($postArrayMap);

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
        $formUnit = $this->interActor->formUnit($this->inputHandler->getArrayMap());

        $view = new \View\Model(
            \View\Customer::form($formUnit),
            $this->inputHandler->routeArrayMap()
        );
        return $view->render();
    }

    /**
     * Entry point list request, renders List, html data
     * @return string
     */
    public function renderList()
    {
        $listUnit = $this->interActor->listUnit($this->inputHandler->getArrayMap());

        $view = new \View\Model(
            \View\Customer::list($listUnit),
            $this->inputHandler->routeArrayMap()
        );
        return $view->render();
    }
}
