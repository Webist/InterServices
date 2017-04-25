<?php


namespace View;


class RootPath
{
    public function get()
    {
        ob_start();
        include '../web/rootpath.php';
        return ob_get_clean();
    }
}