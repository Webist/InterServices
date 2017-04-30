<?php

namespace App\Handler;


use App\Service\CustomerReturnValue;
use App\Source\CustomerQuery;

class Customer implements \App\Spec\Customer
{
    /**
     * Holds route, input information and access to generic handler
     * @var Main
     */
    private $main;

    private $uuid;

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

    public function uuid($id = null)
    {
        if(!empty($id)){
            $this->uuid = $id;
        }

        if($this->uuid === null) {
            $this->uuid = $this->main()->uuid()->toString();
        }
        return $this->uuid;
    }

    /**
     * Handler Customer post xhr, dispatches command operations, update
     * @param $postData
     * @param null $uuid
     * @return CustomerReturnValue
     */
    public function postXhr($postData, $uuid = null)
    {
        \Assert\Assertion::notEmpty($postData);
        \Assert\Assertion::email($postData['email']);

        /** @var \App\Service\ORM $orm */
        $orm = $this->container()->get(self::ORM, function () {
        });
        $entityManager = $orm->entityManager();

        if (empty($uuid)) {

            // A userProfile might be created after sending an eMail
            $customerQuery = new CustomerQuery([], $entityManager);
            $userProfileData = $customerQuery->userProfileDataByEmail($postData['email']);

            if($userProfileData){
                $uuid = $userProfileData->getId();
            } else {
                $uuid = $this->uuid();
            }
        }

        $customerCommand = new \App\Source\CustomerCommand($postData, $entityManager);
        $operations = $customerCommand->postXhrOperations($uuid);

        /** @var \App\Service\Customer $customerService */
        $customerService = $this->container()->get(self::CUSTOMER, function () {
        });
        return $customerService->dispatch($operations);
    }

    /**
     * Handler Customer form, queries uuid, array collection
     * @param $uuid
     * @return array
     */
    public function form($uuid)
    {
        /** @var \App\Service\ORM $orm */
        $orm = $this->container()->get(self::ORM, function () {
        });

        $customerQuery = new \App\Source\CustomerQuery([], $orm->entityManager());
        return $customerQuery->formData($uuid);
    }

    /**
     * Handler Customer list, queries, array collection
     * @return array
     */
    public function list()
    {
        /** @var \App\Service\ORM $doctrine */
        $orm = $this->container()->get(self::ORM, function () {
        });

        $customerQuery = new \App\Source\CustomerQuery([], $orm->entityManager());
        return $customerQuery->listData();
    }
}