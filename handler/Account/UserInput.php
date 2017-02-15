<?php
/**
 * Info
 * Created: 14/02/2017 23:26
 *
 */

namespace Account;

/**
 * Value object.
 * @notice No setters to keep immutable.
 * Class UserInput
 * @package Account
 */
class UserInput
{
    protected $id;
    protected $username;
    protected $passwd;
    protected $rpasswd;
    protected $fullname;

    public function __construct($id = null)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPasswd()
    {
        return $this->passwd;
    }

    /**
     * @param mixed $passwd
     */
    public function setPasswd($passwd)
    {
        $this->passwd = $passwd;
    }

    /**
     * @return mixed
     */
    public function getRpasswd()
    {
        return $this->rpasswd;
    }

    /**
     * @param mixed $rpasswd
     */
    public function setRpasswd($rpasswd)
    {
        $this->rpasswd = $rpasswd;
    }

    /**
     * @return mixed
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * @param mixed $fullname
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;
    }


}