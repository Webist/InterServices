<?php

namespace App\Handler;



class RootPath extends AbstractHandler
{
    function sanitizeMailData($mailData)
    {
        // sanitize
        // filter
        // format (to array) to be able to use in Mailer middleware.
        // use self::MAILER_APP_ID; for security.
        return $mailData;
    }
}
