<?php

namespace Account;




/**
 * @Entity
 * @Table(name="user_profiles")
 * @HasLifecycleCallbacks()
 **/
class UserProfileData implements \Statement\DataObject
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
     * @Assert\Email
     */
    protected $email;

    /**
     * @Column(name="fullname", type="string", length=65, nullable=true)
     */
    protected $fullName;

    /**
     * @Column(type="string", length=65, nullable=true)
     */
    private $phone;

    /**
     * @Column(name="gender", type="string", length=8, nullable=true)
     * @Enum({"male", "female", "trans"})
     */
    private $gender;

    /**
     * @Column(type="string", nullable=true)
     */
    private $address;

    /**
     * @Column(type="string", length=8, nullable=true)
     * @var string
     */
    private $zipcode = '';

    /**
     * @Column(type="string", length=65, nullable=true)
     */
    private $city;

    /**
     * @Column(type="string", length=65, nullable=true)
     */
    private $country;

    /**
     * @Column(type="text", nullable=true)
     */
    private $remarks;


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
     * @return UserProfileData
     */
    public function setId($id)
    {
        $this->id = (string)$id;

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
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return UserProfileData
     */
    public function setPhone(string $phone)
    {
        $this->phone = (string) $phone;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return UserProfileData
     */
    public function setGender(string $gender)
    {
        $this->gender = (string) $gender;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return UserProfileData
     */
    public function setAddress(string $address)
    {
        $this->address = (string) $address;

        return $this;
    }

    /**
     * Set zip code
     * @return string
     */
    public function getZipcode(): string
    {
        return $this->zipcode;
    }

    /**
     * Get zip code
     * @param string $zipcode
     */
    public function setZipcode(string $zipcode)
    {
        $this->zipcode = (string) $zipcode;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return UserProfileData
     */
    public function setCity(string $city)
    {
        $this->city = (string) $city;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return UserProfileData
     */
    public function setCountry(string $country)
    {
        $this->country = (string) $country;

        return $this;
    }

    /**
     * Get remarks
     *
     * @return string
     */
    public function getRemarks()
    {
        return $this->remarks;
    }

    /**
     * Set remarks
     *
     * @param string $remarks
     *
     * @return UserProfileData
     */
    public function setRemarks(string $remarks)
    {
        $this->remarks = (string) $remarks;

        return $this;
    }

    /**
     * Get email
     *
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set email
     *
     * @param \email $email
     *
     * @return UserProfileData
     */
    public function setEmail(string $email)
    {
        $this->email = (string) $email;

        return $this;
    }

    /**
     * Get fullName
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Set fullName
     *
     * @param string $fullName
     *
     * @return UserProfileData
     */
    public function setFullName(string $fullName)
    {
        $this->fullName = (string) $fullName;

        return $this;
    }
}
