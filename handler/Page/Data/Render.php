<?php

namespace Page\Data;

class Render
{
    private $indexKey;
    private $pageData = [];

    public function __construct($indexKey)
    {
        $this->indexKey = $indexKey;
        $this->pageData = include dirname(getcwd()) . '/app/Storage/Routes/' . $indexKey . '.php';
    }

    public function title()
    {
        return $this->pageData['title'];
    }
}