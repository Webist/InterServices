<?php

namespace Account;

/**
 * @Entity
 * @Table(name="users")
 * @HasLifecycleCallbacks
 **/
class UserData
{
    /**
     * @Id
     * @Column(name="id", type="guid")
     * @GeneratedValue(strategy="NONE")
     */
    protected $id;

    /** @Column(name="created_at", type="datetime") */
    protected $createdAt;

    /**
     * @Column(name="updated_at", type="datetime")
     */
    protected $updatedAt;

    /**
     * @Column(type="string", length=65)
     */
    protected $username;

    /**
     * @Column(type="string")
     *
     * https://github.com/jeremykendall/password-validator
     */
    protected $passwd;

    /**
     * @Column(type="string")
     */
    protected $fullname;

    public function __construct($uuid)
    {
        $this->id = $uuid;
        $this->setCreatedAt(new \DateTime());
    }

    /**
     *
     * @PrePersist
     * @OPreUpdate
     */
    public function updatedTimestamps()
    {
        $this->setUpdatedAt(new \DateTime('now'));

        if ($this->getCreatedAt() == null) {
            $this->setCreatedAt(new \DateTime('now'));
        }
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return UserData
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return UserData
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return UserData
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set passwd
     *
     * @param string $passwd
     *
     * @return UserData
     */
    public function setPasswd($passwd)
    {
        $this->passwd = $passwd;

        return $this;
    }

    /**
     * Get passwd
     *
     * @return string
     */
    public function getPasswd()
    {
        return $this->passwd;
    }

    /**
     * Set fullname
     *
     * @param string $fullname
     *
     * @return UserData
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;

        return $this;
    }

    /**
     * Get fullname
     *
     * @return string
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Set id
     *
     * @param guid $id
     *
     * @return UserData
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
