<?php


namespace Mail;


/**
 * Class EmailAuthorize email validation methods
 * @package Mail
 */
class EmailAuthorize
{
    private $messages = [
        'isInvalidInput' => ['error' => 'eMail `%s` is invalid'],
        'isBlackListed' => ['error' => 'eMail `%s` is blacklisted'],
        'isDnsRecord' => ['error' => 'eMail `%s` has no valid DNS']
    ];

    /** @var string */
    private $email = '';

    public function setEmail($email)
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
        if (empty(trim($this->email))) {
            throw new \Exception(sprintf($this->messages['isInvalidInput']['error'], $this->email));
        }
        if ($this->isBlackListed()) {
            throw new \Exception(sprintf($this->messages['isBlackListed']['error'], $this->email));
        }

        if (!$this->isDnsRecord()) {
            throw new \Exception(sprintf($this->messages['isDnsRecord']['error'], $this->email));
        }

        return true;
    }
}