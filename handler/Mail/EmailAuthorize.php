<?php


namespace Mail;


/**
 * Class EmailAuthorize email validation methods
 * @package Mail
 */
class EmailAuthorize
{
    private $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public function isBlackListed()
    {
        $blackList = [];
        return isset($blackList[$this->email]);
    }

    public function isDnsRecord()
    {
        $domain = substr(strstr($this->email, '@'), 1);
        return checkdnsrr($domain);
    }
}