<?php


namespace Mail;


/**
 * Class EmailAuthorize email validation methods
 * @package Mail
 */
class EmailAuthorize
{
    private $messages = [
        'isBlackListed' => ['error' => 'Given eMail %s is blacklisted'],
        'isDnsRecord' => ['error' => 'Given eMail %s has no valid DNS']
    ];
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

    public function execute()
    {
        if ($this->isBlackListed()) {
            throw new \Exception(sprintf($this->messages['blacklisted']['error'], $this->email));
        }

        if (!$this->isDnsRecord()) {
            throw new \Exception(sprintf($this->messages['isDnsRecord']['error'], $this->email));
        }

        return true;
    }
}