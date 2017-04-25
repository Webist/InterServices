<?php


namespace Account;

/**
 * @Entity
 * @Table(name="users")
 * @HasLifecycleCallbacks()
 **/
class UserData
{
    /**
     * @Id
     * @Column(name="id", type="guid")
     * @GeneratedValue(strategy="NONE")
     */
    protected $id;

    /**
     * @var
     * @Column(type="datetime", name="created_at")
     */
    protected $createdAt;

    /**
     * @Column(type="string", length=65)
     */
    protected $name;

    /**
     * The below length depends on the "algorithm" you use for encoding
     * the password, but this works well with bcrypt.
     *
     * @Column(type="string", length=64)
     * @Assert\NotEmpty
     *
     * https://github.com/jeremykendall/password-validator
     */
    protected $passwd;

    /*
     * @OneToMany(targetEntity="UserProfileData", mappedBy="userData")
     * @var UserProfileData
     *
    protected $profiles;
    */

    /**
     * Holds user profile data.
     * @notice No need foreign key refernce when using unique generated id.
     * @var UserProfileData
     */
    protected $profileData;

    public function __construct($uuid)
    {
        $this->id = $uuid;
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

    /**
     * @PrePersist()
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        if ($this->createdAt === null) {
            $this->createdAt = new \DateTime('now');
        }
        return $this->createdAt;
    }

    /**
     * @param \DateTime $dateTime
     * @return $this
     */
    public function setCreatedAt(\DateTime $dateTime)
    {
        $this->createdAt = $dateTime;
        return $this;
    }

    /**
     * @return mixed
     */
    public function profileData()
    {
        return $this->profileData;
    }

    /**
     * @param mixed $profileData
     */
    public function setProfileData($profileData)
    {
        $this->profileData = $profileData;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return UserData
     */
    public function setUsername(string $username)
    {
        $this->username = (string) $username;

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
     * Get passwd
     *
     * @return string
     */
    public function getPasswd()
    {
        return $this->passwd;
    }

    /**
     * Set passwd
     *
     * @param string $passwd
     *
     * @return UserData
     */
    public function setPasswd(string $passwd)
    {
        $this->passwd = (string) $passwd;

        return $this;
    }

    /**
     * Set fullname
     *
     * @param string $fullname
     *
     * @return UserData
     */
    public function setFullname(string $fullname)
    {
        $this->fullname = (string) $fullname;

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
     * Set email
     *
     * @param \email $email
     *
     * @return UserData
     */
    public function setEmail(string $email)
    {
        $this->email = (string) $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return \email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return UserData
     */
    public function setName(string $name)
    {
        $this->name = (string) $name;

        return $this;
    }
}
