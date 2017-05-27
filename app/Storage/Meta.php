<?php


namespace App\Storage;


class Meta implements \App\Contract\Spec\Main
{
    private $route = [];

    public function __construct(array $route)
    {
        $this->route = $route;

        if (!isset($this->route['indexKey'])) {
            throw new \OutOfBoundsException(sprintf('`indexKey` for is not set in `%s`', var_export($this->route, true)));
        }
    }

    public function route()
    {
        return $this->route;
    }

    public function routeArrayMap()
    {
        $fileName = __DIR__ . '/Routes/' . $this->route['indexKey'] . '.php';
        if (!file_exists($fileName)) {
            throw new \LogicException(sprintf('File `%s` not found', $fileName));
        } else {
            return include $fileName;
        }
    }
}