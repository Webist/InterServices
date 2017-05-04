<?php


namespace App\Contract\Behave;


interface React
{
    public function __construct(DataObject $dataObject, \App\Service\ORM $orm);

    public function foundData();

    public function persist();

    public function execute();
}