<?php

namespace App\InterActor;


use App\Service\App;

class Customer implements \App\Contract\Spec\Customer, \App\Contract\Behave\InterActor
{
    /**
     * @var App
     */
    private $app;

    /**
     * RootPath constructor.
     * @param App $app
     */
    public function __construct(\App\Service\App $app)
    {
        $this->app = $app;
    }

    public function app()
    {
        return $this->app;
    }

    /**
     * Post xhr, maintains array map and defines operation, dispatches operations
     * @param $arrayMap
     * @return \Statement\ReturnValue
     */
    public function postXhrReturnValue(array $arrayMap): \Statement\ReturnValue
    {
        \Assert\Assertion::keyExists($arrayMap, 'uuid');
        \Assert\Assertion::email($arrayMap['email']);

        /** @var \App\Service\Customer $customerService */
        $customerService = $this->app->get(self::CUSTOMER);

        $operator = $customerService::OPERATOR_PERSIST;
        $uuid = '';
        if (strlen($arrayMap['uuid']) === $customerService::EXISTING_ITEM_UUID_LENGTH) {
            $operator = $customerService::OPERATOR_MERGE;
            $uuid = $arrayMap['uuid'];
        }

        $customerService->maintainReturnValue($operator, $uuid);
        $operators = $customerService->returnValueOperators($arrayMap);

        $operations = new \Statement\Operations($operators, new \Statement\ReturnValue());
        return $operations->execute();
    }

    /**
     * Form unit, maintains array map and defines operation, dispatches queries
     * @param array $arrayMap
     * @return array
     */
    public function formUnit(array $arrayMap = []): array
    {
        /** @var \App\Service\Customer $customerService */
        $customerService = $this->app->get(self::CUSTOMER);

        $operator = $customerService::OPERATOR_NEW;
        $uuid = '';
        if (!empty($arrayMap)) {
            if (isset($arrayMap['uuid']) && strlen($arrayMap['uuid']) === $customerService::EXISTING_ITEM_UUID_LENGTH) {
                $operator = $customerService::OPERATOR_FIND;
                $uuid = $arrayMap['uuid'];
            }
        }

        $selector = new \Statement\Selector();
        $selector->setPredicates([new \Statement\Predicate('uuid', $operator, [$uuid])]);

        $customerService->maintainForm($selector);
        return $customerService->form();
    }

    /**
     * List unit, maintains array map and defines operation, dispatches queries
     * @param array $arrayMap
     * @return array
     */
    public function listUnit(array $arrayMap = []): array
    {
        /** @var \App\Service\Customer $customerService */
        $customerService = $this->app->get(self::CUSTOMER);

        $operator = $customerService::OPERATOR_FIND_ALL;
        $uuid = '';
        if (!empty($arrayMap)) {
            $operator = $customerService::OPERATOR_FIND;
        }

        $selector = new \Statement\Selector();
        $selector->setPredicates([new \Statement\Predicate('id', $operator, [$uuid])]);

        $customerService->maintainList($selector);
        return $customerService->list();
    }

}