<?php


namespace View;


class RootPath
{
    public static function homePage()
    {
        ob_start();
        include '../web/homePage.php';
        return new \Html\Element(ob_get_clean());
    }
}