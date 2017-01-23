<?php
/**
 * Info
 * Created: 04/01/2017 17:13
 * User: fkus
 */

namespace App\Handler;



class RootPath implements \App\Config\RootPathHandler
{
    private $input;
    public static $global;

    public function __construct($input, GlobalHandler $global)
    {
        $this->input = $input;
        self::$global = $global;
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
