<?php

namespace App\Handler;



class Customer implements \App\Contract\Spec\Customer
{
    /**
     * Holds route, input information and access to generic handler
     * @var \App\Meta\Main
     */
    private $main;

    /**
     * @var \App\Container\Service
     */
    private $container;

    /**
     * Customer constructor.
     * @param \App\Meta\Main $main
     */
    public function __construct(\App\Meta\Main $main, \App\Container\Service $container)
    {
        $this->main = $main;
        $this->container = $container;
    }

    public function main()
    {
        return $this->main;
    }

    /**
     * Handler Customer post xhr data, dispatches command operations, update
     * @param $postData
     * @param null $uuid
     * @return \App\ReturnValue\Customer
     */
    public function postXhrData($postData)
    {
        \Assert\Assertion::keyExists($postData, 'uuid');
        \Assert\Assertion::notEmpty($postData);
        \Assert\Assertion::email($postData['email']);

        /** @var \App\Service\Customer $customerService */
        $customerService = $this->container->get(self::CUSTOMER);
        $customerService->setLifeCyclePostXhrData($postData);
        return $customerService->mutate();
    }

    /**
     * Handler Customer form data, queries uuid, array collection
     * @param $uuid
     * @return array
     */
    public function formData($uuid = '')
    {
        /** @var \App\Service\Customer $customerService */
        $customerService = $this->container->get(self::CUSTOMER);
        $customerService->setLifeCycleFormData($uuid);
        return $customerService->operations();
    }

    /**
     * Handler Customer list data, queries, array collection
     * @param null $uuid
     * @return mixed
     */
    public function listData($uuid = '')
    {
        /** @var \App\Service\Customer $customerService */
        $customerService = $this->container->get(self::CUSTOMER);
        $customerService->setLifeCycleListData($uuid);
        return $customerService->operations();
    }
}