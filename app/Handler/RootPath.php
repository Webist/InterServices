<?php

namespace App\Handler;



class RootPath implements \App\Main\RootPathHandler
{
    private $input;
    public static $main;

    public function __construct($input, Main $main)
    {
        $this->input = $input;
        self::$main = $main;
    }

    function sanitizeMailData($mailData)
    {
        // sanitize
        // filter
        // format (to array) to be able to use in Mailer middleware.
        // use self::MAILER_APP_ID; for security.
        return $mailData;
    }
}
