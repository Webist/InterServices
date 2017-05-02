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
     * @var \App\Service\ORM
     */
    private $orm;

    /**
     *
     * @var \App\Service\Customer
     */
    private $service;

    /**
     * Customer constructor.
     * @param Main $main
     */
    public function __construct(Main $main)
    {
        $this->main = $main;

        $this->orm = $this->main->container()->get(\App\Service\ORM::class, function () {
        });
        $this->service = $this->main->container()->get(self::CUSTOMER, function () {
        });
    }

    /**
     * Handler Customer post xhr data, dispatches command operations, update
     * @param $postData
     * @param null $uuid
     * @return CustomerReturnValue
     */
    public function postXhrData($postData, $uuid = null)
    {
        \Assert\Assertion::notEmpty($postData);
        \Assert\Assertion::email($postData['email']);

        $operations = function () use ($postData, $uuid) {

            if (empty($uuid)) {

                // A userProfile might already exists, it might be created after sending an eMail
                $customerQuery = new CustomerQuery([], $this->orm);
                $userProfileData = $customerQuery->userProfileDataByEmail($postData['email']);

                if ($userProfileData) {
                    $uuid = $userProfileData->getId();
                } else {
                    $uuid = $this->uuid();
                }
            }

            $operations = new \App\Source\CustomerOperation($postData);
            return $operations->postXhrOperations($uuid, $this->orm);
        };

        return $this->service->dispatch($operations);
    }

    public function uuid($id = null)
    {
        if (!empty($id)) {
            $this->uuid = $id;
        }

        if ($this->uuid === null) {
            $this->uuid = $this->main()->uuid()->toString();
        }
        return $this->uuid;
    }

    public function main()
    {
        return $this->main;
    }

    /**
     * Handler Customer form data, queries uuid, array collection
     * @param $uuid
     * @return array
     */
    public function formData($uuid)
    {
        $operations = function () use ($uuid) {
            $query = new \App\Source\CustomerQuery([], $this->orm);
            return $query->formDataOperations($uuid);
        };

        return $this->service->get($operations);

    }

    /**
     * Handler Customer list data, queries, array collection
     * @param null $uuid
     * @return mixed
     */
    public function listData($uuid = null)
    {
        $operations = function () use ($uuid) {
            $query = new \App\Source\CustomerQuery([], $this->orm);
            return $query->listDataOperations();
        };

        return $this->service->get($operations);
    }
}