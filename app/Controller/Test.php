<?php

namespace App\Controller;

/*
 * @notice, this file used for generating errors intentionally
 */
class Test
{
    public function index()
    {
        return "This is the TestController::index class ".PHP_EOL;
    }

    public function pageDataHandler($indexKey)
    {
        // in a MOM structure the indexKey and fetching data function would be built in $this->handler
        $pageDataHandler = new \Page\Data\Handler($indexKey);
        return $pageDataHandler;
    }
}
