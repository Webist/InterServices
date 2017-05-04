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
    public function postXhrData($postData, $uuid = null)
    {
        \Assert\Assertion::notEmpty($postData);
        \Assert\Assertion::email($postData['email']);

        /** @var \App\Service\Customer $customerService */
        $customerService = $this->container->get(self::CUSTOMER,
            new \App\Source\CustomerStatement($postData),
            new \App\Operator\Customer()
        );

        if (empty($uuid)) {
            $uuid = $customerService->uuidByEmail($postData['email']);
        }

        $customerService->postXhrDataOperations(new \App\Source\CustomerStatement($postData), $uuid);
        return $customerService->mutate();
    }

    /**
     * Handler Customer form data, queries uuid, array collection
     * @param $uuid
     * @return array
     */
    public function formData($uuid)
    {
        /** @var \App\Service\Customer $customerService */
        $customerService = $this->container->get(self::CUSTOMER,
            new \App\Source\CustomerStatement([]),
            new \App\Operator\Customer()
        );
        $customerService->formDataOperations(new \App\Source\CustomerQuery([]), $uuid);
        return $customerService->get();
    }

    /**
     * Handler Customer list data, queries, array collection
     * @param null $uuid
     * @return mixed
     */
    public function listData($uuid = null)
    {
        /** @var \App\Service\Customer $customerService */
        $customerService = $this->container->get(self::CUSTOMER,
            new \App\Source\CustomerStatement([]),
            new \App\Operator\Customer()
        );
        $customerService->listDataOperations(new \App\Source\CustomerQuery([]), $uuid);
        return $customerService->get();
    }
}