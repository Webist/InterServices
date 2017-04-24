<?php

namespace Account;

/**
 * @Entity
 * @Table(name="user_profiles")
 **/
class UserProfileData
{
    /**
     * @Id
     * @Column(name="id", type="guid")
     * @GeneratedValue(strategy="NONE")
     */
    protected $id;

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
     * @Column(type="string", length=8)
     * @var string
     */
    private $zipcode = '';

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
    public function setGender(string $gender)
    {
        $this->gender = (string) $gender;

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
    public function setAddress(string $address)
    {
        $this->address = (string) $address;

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
     * Get zip code
     * @param string $zipcode
     */
    public function setZipcode(string $zipcode)
    {
        $this->zipcode = (string) $zipcode;
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
    public function setCountry(string $country)
    {
        $this->country = (string) $country;

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
    public function setRemarks(string $remarks)
    {
        $this->remarks = (string) $remarks;

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
    public function setId(string $id)
    {
        $this->id = (string) $id;

        return $this;
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
    public function setFullName(string $fullName)
    {
        $this->fullName = (string) $fullName;

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
