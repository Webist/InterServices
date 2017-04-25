<?php


namespace App\Service;


class Html
{
    private $callback;

    public function __construct(\Closure $callback)
    {
        $this->callback = $callback;
    }

    /**
     * Page base content parser
     *
     * @param array $pageData
     * @return \Html\Composite
     */
    public function pageBaseContent(array $pageData)
    {
        return \View\BaseContent::buildContentWith(':pageBaseContent', $this->invoke(), $pageData);
    }

    public function invoke()
    {
        return call_user_func($this->callback);
    }
}