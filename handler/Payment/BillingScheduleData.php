<?php


namespace Payment;


/**
 * @Entity
 * @Table(name="billing_schedules")
 * @HasLifecycleCallbacks()
 *
 **/
class BillingScheduleData implements \Statement\DataObject
{
    /**
     * @Id
     * @Column(name="id", type="guid")
     * @GeneratedValue(strategy="NONE")
     */
    protected $id;

    /** @Column(type="datetime", name="created_at") */
    protected $createdAt;

    /**
     * @var integer
     * @Column(type="smallint", length=65, nullable=true)
     */
    protected $period;

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
     * @param integer $id
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
     * @return int
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * @param $period
     * @return $this
     */
    /**
     * @param int $period
     * @return $this
     */
    public function setPeriod(int $period)
    {
        $this->period = $period;
        return $this;
    }
}