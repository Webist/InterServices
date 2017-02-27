<?php

namespace Account;

/**
 * @Entity
 * @Table(name="user_profiles")
 * @HasLifecycleCallbacks
 **/
class UserProfileData
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
     * @Assert\Email
     */
    protected $email;

    /**
     * @Column(name="fullname", type="string", length=65)
     */
    protected $fullName;

    /**
     * @Column(type="string", length=65)
     */
    private $phone;

    /**
     * @Column(name="gender", type="string", length=8)
     * @Enum({"male", "female", "trans"})
     */
    private $gender;

    /**
     * @Column(type="string")
     */
    private $address;

    /**
     * @Column(type="string", length=65)
     */
    private $city;

    /**
     * @Column(type="string", length=65)
     */
    private $country;

    /**
     * @Column(type="text")
     */
    private $remarks;


    private $creditCard;

    public function __construct($uuid = null)
    {
        $this->id = $uuid;
        // $this->setCreatedAt(new \DateTime());
    }

    /**
     *
     * @PrePersist
     * @PreUpdate
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
     * @return guid
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
     * @return UserProfileData
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
     * @return UserProfileData
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
     * Set phone
     *
     * @param string $phone
     *
     * @return UserProfileData
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

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
     * Set gender
     *
     * @param string $gender
     *
     * @return UserProfileData
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

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
     * Set address
     *
     * @param string $address
     *
     * @return UserProfileData
     */
    public function setAddress($address)
    {
        $this->address = $address;

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
     * Set city
     *
     * @param string $city
     *
     * @return UserProfileData
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
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
     * Set country
     *
     * @param string $country
     *
     * @return UserProfileData
     */
    public function setCountry($country)
    {
        $this->country = $country;

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
     * Set remarks
     *
     * @param string $remarks
     *
     * @return UserProfileData
     */
    public function setRemarks($remarks)
    {
        $this->remarks = $remarks;

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
     * Set id
     *
     * @param guid $id
     *
     * @return UserProfileData
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set email
     *
     * @param \email $email
     *
     * @return UserProfileData
     */
    public function setEmail( $email)
    {
        $this->email = $email;

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
     * Set fullName
     *
     * @param string $fullName
     *
     * @return UserProfileData
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

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
}
