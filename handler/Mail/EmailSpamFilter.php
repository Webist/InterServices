<?php


namespace Mail;


/**
 * Class EmailSpamFilter
 * @package Mail
 *
 */
class EmailSpamFilter
{
    private $email;

    public function __construct($email)
    {
        $this->email = $email;

        try {

            if($this->isBlackListed()){
                throw new \Exception("Given eMail `$this->email` is blacklisted");
            }

            // todo skip dns record check if ... the eMail is already in db
            if(!$this->isDnsRecord()){
                throw new \Exception("Given eMail `$this->email` has no valid DNS");
            }

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        return $this->email;
    }

    private function isBlackListed()
    {
        $blackList = [];
        return isset($blackList[$this->email]);
    }

    private function isDnsRecord()
    {
        $domain = substr(strstr($this->email, '@'), 1);
        return checkdnsrr($domain);
    }

    public function getEmail()
    {
        return $this->email;
    }

}