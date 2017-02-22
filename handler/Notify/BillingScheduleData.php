<?php


namespace Notify;

/**
 * @Entity
 * @Table(name="billing_schedules")
 * @HasLifecycleCallbacks
 **/
class BillingScheduleData
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
     * @Column(type="smallint")
     */
    protected $period;

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
     * @return CreditCardData
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
     * @return CreditCardData
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

    public function setPeriod($period)
    {
        $this->period = $period;
    }

    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * Set id
     *
     * @param guid $id
     *
     * @return BillingScheduleData
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
