<?php

namespace Commerce;

/**
 * @Entity
 * @Table(name="customers")
 * @HasLifecycleCallbacks()
 **/
class CustomerData implements \Statement\DataObject
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
     * @var
     * @Column(type="datetime", name="created_at", options={"default"="CURRENT_TIMESTAMP"})
     */
    protected $createdAt;

    /**
     *
     * @var
     * @Column(type="string", length=8, nullable=true)
     */
    protected $status;

    /**
     *
     *
     * @Column(type="string", length=8, nullable=true)
     */
    private $state;

    /**
     * 
     * @var
     * @Column(type="string", length=22, nullable=true)
     */
    private $timezone;

    /**
     *
     *
     * @Column(type="string", length=6, nullable=true)
     */
    private $locale;

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
     * @return CustomerData
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
     * Get status
     *
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
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
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
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
     * Get timezone
     *
     * @return string
     */
    public function getTimezone()
    {
        return $this->timezone;
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
     * Get locale
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
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
}
