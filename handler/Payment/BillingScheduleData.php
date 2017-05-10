<?php


namespace Payment;


/**
 * @Entity
 * @Table(name="billing_schedules")
 * @HasLifecycleCallbacks()
 *
 **/
class BillingScheduleData implements \App\Contract\Behave\DataObject
{
    /**
     * @Id
     * @Column(name="id", type="guid")
     * @GeneratedValue(strategy="NONE")
     */
    protected $id;

    /** @Column(type="datetime", name="created_at") */
    protected $createdAt;

    /** @Column(type="smallint", length=65, nullable=true) */
    protected $period;

    public function __construct($uuid)
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
     * Set id
     *
     * @param guid $id
     *
     * @return $this
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
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * @param $period
     * @return $this
     */
    public function setPeriod($period)
    {
        $this->period = $period;
        return $this;
    }
}