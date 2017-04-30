<?php

namespace App\Controller;

/**
 * @notice, this file used for generating errors intentionally
 */
class Test
{
    /**
     * Entry point test string request, renders Test String
     * @return string
     */
    public function renderTestString()
    {
        return "This is the TestController::index class ".PHP_EOL;
    }

    public function renderPageData($indexKey)
    {
        // in a MOM structure the indexKey and fetching data function would be built in $this->handler
        $renderPageData = new \Page\Data\Handler($indexKey);
        return $renderPageData;
    }
}
