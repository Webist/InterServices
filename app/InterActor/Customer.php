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
        /** @var \App\Service\Customer $customerService */
        $customerService = $this->container->get(self::CUSTOMER);
        // Query
        $customerService->maintainLifeCyclePostXhrData($postData);
        // Command
        $customerService->setLifeCyclePostXhrData();
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
        // Query
        $customerService->maintainLifeCycleFormData($uuid);
        return $customerService->queries();
    }

    /**
     * InterActor Customer list data, queries, array collection
     * @param string $uuid
     * @return array
     */
    public function listData($uuid = '')
    {
        /** @var \App\Service\Customer $customerService */
        $customerService = $this->container->get(self::CUSTOMER);
        // Query
        $customerService->maintainLifeCycleListData($uuid);
        return $customerService->queries();
    }
}