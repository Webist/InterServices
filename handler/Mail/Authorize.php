<?php


namespace Mail;


class Authorize
{
    private $matchContext = [
        \Mail\EmailAuthorize::class => [
            'isBlackListed' => ['result' => false, 'error' => 'Given eMail %s is blacklisted'],
            'isDnsRecord' => ['result' => true, 'error' => 'Given eMail %s has no valid DNS']
        ]
    ];

    private $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public function execute()
    {
        foreach ($this->matchContext as $class => $methods) {
            $object = new $class($this->email);
            foreach ($methods as $method => $returnValue) {
                $this->result(
                    call_user_func([$object, $method]),
                    $returnValue['result'],
                    $returnValue['error']
                );
            }
        }
        return true;
    }

    private function result($bool, $returnValue, $error)
    {
        if ($bool !== $returnValue) {
            throw new \Exception(sprintf($error, $this->email));
        }
    }
}