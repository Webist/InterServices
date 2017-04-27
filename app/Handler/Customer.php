<?php

namespace App\Handler;


class Customer implements \App\Spec\Customer
{
    /**
     * Holds route, input information and access to generic handler
     * @var Main
     */
    private $main;

    /**
     * Customer constructor.
     * @param Main $main
     */
    public function __construct(Main $main)
    {
        $this->main = $main;
    }

    public function main()
    {
        return $this->main;
    }

    public function container()
    {
        return $this->main->container();
    }

    /**
     * @param $postData
     * @param null $uuid
     * @return array
     */
    public function postXhr($postData, $uuid = null)
    {
        \Assert\Assertion::notEmpty($postData);
        \Assert\Assertion::email($postData['email']);

        $customerCommand = new \App\Source\CustomerCommand($this->container());
        $operations = $customerCommand->postXhrOperations($postData, $uuid);

        /** @var \App\Service\Customer $customerService */
        $customerService = $this->container()->get(self::CUSTOMER, function () {});
        return $customerService->mutate($operations);
    }

    /**
     * @param $uuid
     * @param $customerData \App\Spec\Customer::CUSTOMER_DATA
     * @return array
     */
    public function form($uuid, $customerData)
    {
        if($customerData !== \App\Spec\Customer::CUSTOMER_EDIT) {
            throw \InvalidArgumentException('Invlid argument CUSTOMER_EDIT');
        }

        $customerQuery = new \App\Source\CustomerQuery($this->container());
        return $customerQuery->formData($uuid);
    }

    /**
     * @return array
     */
    public function list()
    {
        $customerQuery = new \App\Source\CustomerQuery($this->container());
        $repo = $customerQuery->listData();
        return $repo->findAll();
    }

}