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
     * @var \App\Service\Container
     */
    private $container;

    /**
     * Customer constructor.
     * @param \App\Storage\Meta $meta
     * @param \App\Service\Container $container
     */
    public function __construct(\App\Storage\Meta $meta, \App\Service\Container $container)
    {
        $this->meta = $meta;
        $this->container = $container;
    }

    public function meta()
    {
        return $this->meta;
    }

    /**
     * Post xhr data, maintains array map, executes operations
     * @param $arrayMap
     * @return \Statement\ReturnValue
     */
    public function postXhrArrayMap(array $arrayMap): \Statement\ReturnValue
    {
        \Assert\Assertion::keyExists($arrayMap, 'uuid');
        \Assert\Assertion::email($arrayMap['email']);

        /** @var \App\Service\Customer $customerService */
        $customerService = $this->container->get(self::CUSTOMER);

        $queries = $customerService->maintainMutationMap($arrayMap);
        $operations = $customerService->prepareOperations($queries);
        return $customerService->mutate($operations);
    }

    /**
     * Form unit, maintains uuid, queries array map
     * @param $uuid
     * @return array
     */
    public function formUnit($uuid = ''): array
    {
        /** @var \App\Service\Customer $customerService */
        $customerService = $this->container->get(self::CUSTOMER);

        $queries = $customerService->maintainFormUnit($uuid);
        $operations = $customerService->prepareOperations($queries);
        return $customerService->get($operations);
    }

    /**
     * List unit, maintains uuid, queries array map
     * @param string $uuid
     * @return array
     */
    public function listUnit($uuid = ''): array
    {
        /** @var \App\Service\Customer $customerService */
        $customerService = $this->container->get(self::CUSTOMER);

        $queries = $customerService->maintainListUnit($uuid);
        return $customerService->get($queries);
    }

}