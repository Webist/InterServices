<?php

namespace App\InterActor;


class Customer implements \App\Contract\Spec\Customer, \App\Contract\Behave\InterActor
{
    /**
     * Holds route, input information and access to generic handler
     * @var \App\Storage\Meta
     */
    private $meta;

    /**
     * @var App
     */
    private $app;

    /**
     * RootPath constructor.
     * @param \App\Storage\Meta $meta
     * @param App $app
     */
    public function __construct(\App\Storage\Meta $meta, \App\InterActor\App $app)
    {
        $this->meta = $meta;
        $this->app = $app;
    }

    public function meta()
    {
        return $this->meta;
    }

    public function app()
    {
        return $this->app;
    }

    /**
     * Post xhr data, maintains array map, executes operations
     * @param $arrayMap
     * @return \Statement\ReturnValue
     */
    public function postXhrReturnValue(array $arrayMap): \Statement\ReturnValue
    {
        \Assert\Assertion::keyExists($arrayMap, 'uuid');
        \Assert\Assertion::email($arrayMap['email']);

        /** @var \App\Service\Customer $customerService */
        $customerService = $this->app->get(self::CUSTOMER);

        if (empty($arrayMap['uuid'])) {
            $operator = $customerService::OPERATOR_PERSIST;
            $uuid = \Ramsey\Uuid\Uuid::uuid4()->toString();
        } else {
            $operator = $customerService::OPERATOR_MERGE;
            $uuid = $arrayMap['uuid'];
        }

        $returnValueUnit = $customerService->maintainReturnValueUnit($operator, $uuid);
        $operations = $customerService->returnValueOperations($returnValueUnit, $arrayMap);
        return $customerService->mutate($operations);
    }

    /**
     * Form unit, maintains uuid, queries array map
     * @param array $arrayMap
     * @return array
     */
    public function formUnit(array $arrayMap = []): array
    {
        /** @var \App\Service\Customer $customerService */
        $customerService = $this->app->get(self::CUSTOMER);

        if (empty($arrayMap)) {
            $operator = $customerService::OPERATOR_NEW;
        } else {
            $operator = $customerService::OPERATOR_FIND;
        }

        $customerService->maintainFormUnit($operator);
        return $customerService->get($arrayMap);
    }

    /**
     * List unit, maintains uuid, queries array map
     * @param array $arrayMap
     * @return array
     */
    public function listUnit(array $arrayMap = []): array
    {
        /** @var \App\Service\Customer $customerService */
        $customerService = $this->app->get(self::CUSTOMER);

        if (empty($arrayMap)) {
            $operator = $customerService::OPERATOR_FIND_ALL;
        } else {
            $operator = $customerService::OPERATOR_NEW;
        }

        $customerService->maintainListUnit($operator);
        return $customerService->get($arrayMap);
    }

}