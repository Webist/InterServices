<?php

namespace App\Handler;


class AbstractHandler implements \App\Spec\RootPathHandler
{
    private $input;
    private $main;

    public function __construct($input, Main $main)
    {
        $this->input = $input;
        $this->main = $main;
    }

    public function service(string $class, array $arguments = [])
    {
        return $this->main->service($class, $arguments);
    }
}