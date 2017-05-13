<?php

namespace App\InterActor;



class Customer implements \App\Contract\Spec\Customer
{
    /**
     * Holds route, input information and access to generic handler
     * @var \App\Storage\Meta
     */
    private $meta;

    /**
     * @var \App\Container\Service
     */
    private $container;

    /**
     * Customer constructor.
     * @param \App\Storage\Meta $meta
     */
    public function __construct(\App\Storage\Meta $meta, \App\Container\Service $container)
    {
        $this->meta = $meta;
        $this->container = $container;
    }

    public function meta()
    {
        return $this->meta;
    }

    /**
     * InterActor Customer post xhr data, dispatches command operations, update
     * @param $postData
     * @param null $uuid
     * @return \Commerce\ReturnValue
     */
    public function postXhrData($postData)
    {
        $customerAction = new \App\Contract\Action\Customer($postData);
        $customerAction->assertPostXhrData();

        /** @var \App\Service\Customer $customerService */
        $customerService = $this->container->get(self::CUSTOMER);
        $customerService->setLifeCyclePostXhrData($postData);
        return $customerService->mutate();
    }

    /**
     * InterActor Customer form data, queries uuid, array collection
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
     * InterActor Customer list data, queries, array collection
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