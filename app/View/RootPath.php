<?php


namespace View;


class RootPath
{
    public static function get()
    {
        ob_start();
        include '../web/rootpath.php';
        return new \Html\Element(ob_get_clean());
    }
}