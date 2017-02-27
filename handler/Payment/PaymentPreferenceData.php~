<?php


namespace Payment;

/**
 * @Entity
 * @Table(name="payment_preferences")
 * @HasLifecycleCallbacks
 *
 **/
class PaymentPreferenceData
{
    /**
     * @Id
     * @Column(name="id", type="guid")
     * @GeneratedValue(strategy="NONE")
     */
    protected $id;

    /** @Column(name="created_at", type="datetime") */
    protected $createdAt;

    /** @Column(name="updated_at", type="datetime") */
    protected $updatedAt;

    /** @Column(type="string", length=8) */
    protected $status;

    /** @Column(type="string", length=22) */
    protected $method;

    /** @Column(columnDefinition="TINYINT DEFAULT 1 NOT NULL") */
    protected $autopay;

    public function __construct($uuid = null)
    {
        $this->id = $uuid;
        $this->setCreatedAt(new \DateTime());
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
     * Set id
     *
     * @param guid $id
     *
     * @return PaymentPreferenceData
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return PaymentPreferenceData
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
     * @return PaymentPreferenceData
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
     * Set status
     *
     * @param string $status
     *
     * @return PaymentPreferenceData
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set method
     *
     * @param string $method
     *
     * @return PaymentPreferenceData
     */
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Get method
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set autopay
     *
     * @param string $autopay
     *
     * @return PaymentPreferenceData
     */
    public function setAutopay($autopay)
    {
        $this->autopay = $autopay;

        return $this;
    }

    /**
     * Get autopay
     *
     * @return string
     */
    public function getAutopay()
    {
        return $this->autopay;
    }
}
