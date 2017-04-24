<?php

namespace Commerce;

/**
 * @Entity
 * @Table(name="customers")
 **/
class CustomerData
{
    /**
     *
     * @var
     * @Id
     * @Column(name="id", type="guid")
     * @GeneratedValue(strategy="NONE")
     */
    protected $id;

    /**
     *
     * @var
     * @Column(type="string", length=8)
     */
    protected $status;

    /**
     *
     *
     * @Column(type="string", length=8)
     */
    private $state;

    /**
     * 
     * @var
     * @Column(type="string", length=22)
     */
    private $timezone;

    /**
     *
     *
     * @Column(type="string", length=6)
     */
    private $locale;

    public function __construct($uuid = null)
    {
        $this->id = $uuid;
    }

    /**
     * Set id
     *
     * @param guid $id
     *
     * @return CustomerData
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * Set status
     *
     * @param string $status
     *
     * @return CustomerData
     */
    public function setStatus(string $status)
    {
        $this->status = (string) $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus() : string
    {
        return $this->status;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return CustomerData
     */
    public function setState(string $state)
    {
        $this->state = (string) $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set timezone
     *
     * @param string $timezone
     *
     * @return CustomerData
     */
    public function setTimezone(string $timezone)
    {
        $this->timezone = (string) $timezone;

        return $this;
    }

    /**
     * Get timezone
     *
     * @return string
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * Set locale
     *
     * @param string $locale
     *
     * @return CustomerData
     */
    public function setLocale(string $locale)
    {
        $this->locale = (string) $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }
}
