<?php


namespace Account;


/**
 * @Entity
 * @Table(name="users")
 * @HasLifecycleCallbacks()
 **/
class UserData implements \Statement\DataObject
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
     * @Column(type="string", length=65, nullable=true)
     */
    protected $name;

    /**
     * The below length depends on the "algorithm" you use for encoding
     * the password, but this works well with bcrypt.
     *
     * @Column(type="string", length=64, nullable=true)
     *
     * https://github.com/jeremykendall/password-validator
     */
    protected $passwd;

    /**
     * @var
     * @Column(type="string", length=65, nullable=true)
     */
    protected $username;

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
     *
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param  $id
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
     * @return UserProfileData
     */
    public function profileData()
    {
        return $this->profileData;
    }

    /**
     * @param UserProfileData $profileData
     */
    public function setProfileData(UserProfileData $profileData)
    {
        $this->profileData = $profileData;
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
