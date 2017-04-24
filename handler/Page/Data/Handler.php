<?php

namespace Page\Data;

class Handler
{
    private $indexKey;
    private $pageData = [];

    public function __construct($indexKey)
    {
        $this->indexKey = $indexKey;
        $this->pageData = include dirname(getcwd()) . '/app/DataStorage/'.$indexKey.'.php';
    }

    public function title()
    {
        return $this->pageData['title'];
    }
}