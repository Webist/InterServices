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

        if (empty($arrayMap['uuid'])) {
            $operator = \Statement\Operator::CREATE;
        } else {
            $operator = \Statement\Operator::SET;
        }

        $queries = $customerService->maintainMutationUnit($operator);
        $operations = $customerService->mutationUnitOperations($queries, $arrayMap);
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

        if (empty($uuid)) {
            $operator = $customerService::OPERATOR_NEW;
        } else {
            $operator = $customerService::OPERATOR_FIND;
        }

        $customerService->maintainFormUnit($operator);
        return $customerService->get($uuid);
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

        if (empty($uuid)) {
            $operator = $customerService::OPERATOR_FIND_ALL;
        } else {
            $operator = $customerService::OPERATOR_NEW;
        }

        $customerService->maintainListUnit($operator);
        return $customerService->get($uuid);
    }

}