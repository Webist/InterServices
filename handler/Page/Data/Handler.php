<?php
/**
 * Info
 * Created: 13/01/2017 19:24
 * User: fkus
 */

namespace Page\Data;

class Handler
{
    private $indexKey;
    private $pageData = [];

    public function __construct($indexKey)
    {
        $this->indexKey = $indexKey;
        $this->pageData = include dirname(getcwd()) . '/app/Data/'.$indexKey.'.php';
    }

    public function title()
    {
        return $this->pageData['title'];
    }
}