<?php


namespace View;


class RootPath
{
    public static function modelPage($data)
    {
        ob_start();
        include '../web/homePage.php';
        return new \Dom\Html\Element(ob_get_clean());
    }
}