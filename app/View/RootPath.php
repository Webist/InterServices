<?php


namespace View;


class RootPath
{
    public static function page(array $contentArrayMap)
    {
        ob_start();
        include dirname(dirname(__DIR__)) . '/web/homePage.php';
        return new \Dom\Html\Element(ob_get_clean());
    }
}